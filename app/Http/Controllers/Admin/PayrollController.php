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

        $totalPengeluaran = $payrolls->where('status', 'paid')->sum('net_salary');
        $totalPotongan = $payrolls->where('status', 'paid')->sum('wajib_deduction');

        return view('admin.penggajian.index', compact(
            'payrolls', 'organisasi', 'totalPengeluaran', 'totalPotongan'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'period_month' => 'required|integer|between:1,12',
            'period_year' => 'required|integer|min:2024',
        ]);

        $employees = User::role(['pengurus', 'pengawas', 'admin'])->get();
        $organization = Organization::first();
        $wajibAmount = $organization?->wajib_amount ?? 100000;

        $count = 0;
        foreach ($employees as $employee) {
            $exists = Payroll::where('user_id', $employee->id)
                ->where('period_month', $request->period_month)
                ->where('period_year', $request->period_year)
                ->exists();

            if ($exists) {
                continue;
            }

            $baseSalary = match (true) {
                $employee->hasRole('admin') => 7500000,
                $employee->hasRole('pengurus') => 5000000,
                $employee->hasRole('pengawas') => 4000000,
                default => 3500000,
            };

            $allowance = 500000;
            $netSalary = $baseSalary + $allowance - $wajibAmount;

            Payroll::create([
                'user_id' => $employee->id,
                'period_month' => $request->period_month,
                'period_year' => $request->period_year,
                'base_salary' => $baseSalary,
                'allowance' => $allowance,
                'wajib_deduction' => $wajibAmount,
                'other_deduction' => 0,
                'net_salary' => $netSalary,
                'status' => 'processed',
            ]);

            $count++;
        }

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'process_payroll',
            'description' => "Memproses penggajian periode {$request->period_month}/{$request->period_year} untuk {$count} karyawan",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.penggajian')
            ->with('success', "Penggajian periode {$request->period_month}/{$request->period_year} berhasil diproses untuk {$count} karyawan!");
    }
}
