<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use Illuminate\View\View;

class RekapAngsuranController extends Controller
{
    public function index(): View
    {
        $lancarCount = Installment::where('status', 'paid')->count();
        $menunggakCount = Installment::where('status', 'pending')
            ->where('due_date', '<', now())
            ->count();
        $totalAktif = Installment::count();

        $daftarAngsuran = Loan::with('user', 'installments')
            ->whereIn('status', ['active', 'approved', 'paid'])
            ->get()
            ->flatMap(function ($loan) {
                return $loan->installments->map(function ($inst) use ($loan) {
                    $isOverdue = $inst->status === 'pending' && $inst->due_date < now();
                    return [
                        'nama_anggota' => $loan->user->name,
                        'no_pinjaman' => $loan->loan_number,
                        'angsuran_ke' => $inst->installment_number . '/' . $loan->tenure_months,
                        'total_angsuran' => $inst->amount,
                        'sisa_outstanding' => $loan->installments->where('status', 'pending')->sum('amount'),
                        'status_label' => $isOverdue ? 'menunggak' : ($inst->status === 'paid' ? 'lancar' : 'pending'),
                    ];
                });
            })
            ->sortByDesc(function ($item) {
                return $item['status_label'] === 'menunggak' ? 0 : 1;
            })
            ->values();

        return view('pengawas.rekapangsuran.index', compact(
            'lancarCount', 'menunggakCount', 'totalAktif', 'daftarAngsuran'
        ));
    }
}
