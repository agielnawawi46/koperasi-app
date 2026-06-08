<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Organization;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PayrollController extends Controller
{
    public function index(): View
    {
        $payrolls = Payroll::with('user.roles')
            ->orderBy('period_year', 'desc')
            ->orderBy('period_month', 'desc')
            ->get();

        $org = Organization::first();
        $organisasi = $org ? [
            'nama' => $org->name,
            'perusahaan' => $org->company_name,
            'email' => $org->email,
            'alamat' => $org->address,
            'pokok' => $org->pokok_amount,
            'wajib' => $org->wajib_amount,
            'bunga' => $org->bunga_rate,
            'metode' => $org->metode,
            'payment_method' => $org->payment_method,
            'tgl_tagihan' => $org->tgl_tagihan,
        ] : ['wajib' => 100000];

        $employees = User::with('roles')
            ->role('anggota')
            ->orderBy('name')
            ->get()
            ->map(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->roles->first()?->name ?? '',
                'base_salary' => $user->base_salary ? (int) $user->base_salary : 3500000,
            ]);

        $totalPengeluaran = $payrolls->where('status', 'paid')->sum('net_salary');
        $totalPotongan = $payrolls->where('status', 'paid')->sum('wajib_deduction');

        return view('admin.penggajian.index', compact(
            'payrolls', 'employees', 'organisasi', 'totalPengeluaran', 'totalPotongan'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'karyawan_id' => 'required|exists:users,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'potongan_simpanan' => 'required|numeric|min:0',
            'gaji_bersih' => 'required|numeric|min:0',
        ]);

        $periodMonth = now()->format('n');
        $periodYear = now()->format('Y');

        $exists = Payroll::where('user_id', $request->karyawan_id)
            ->where('period_month', $periodMonth)
            ->where('period_year', $periodYear)
            ->exists();

        if ($exists) {
            return redirect()->route('admin.penggajian')
                ->with('error', 'Karyawan ini sudah memiliki data penggajian untuk periode ini.');
        }

        Payroll::create([
            'user_id' => $request->karyawan_id,
            'period_month' => $periodMonth,
            'period_year' => $periodYear,
            'base_salary' => $request->gaji_pokok,
            'allowance' => 0,
            'wajib_deduction' => $request->potongan_simpanan,
            'other_deduction' => 0,
            'net_salary' => $request->gaji_bersih,
            'status' => 'processed',
        ]);

        $user = User::find($request->karyawan_id);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'process_payroll',
            'description' => "Memproses penggajian untuk {$user->name} periode {$periodMonth}/{$periodYear}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.penggajian')
            ->with('success', "Penggajian untuk {$user->name} periode {$periodMonth}/{$periodYear} berhasil diproses!");
    }
}
