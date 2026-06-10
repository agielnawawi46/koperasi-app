<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\SavingsTransaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $simpananBulanIni = SavingsTransaction::where('status', 'approved')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $loanStats = Loan::selectRaw("
            COALESCE(SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END), 0) as pengajuan_pending,
            COALESCE(SUM(CASE WHEN status IN ('active','approved','ready_for_disbursement') THEN 1 ELSE 0 END), 0) as pinjaman_aktif,
            COALESCE(SUM(CASE WHEN status IN ('active','approved','ready_for_disbursement') THEN total_payment ELSE 0 END), 0) as total_outstanding
        ")->first();

        $pengajuanPending = $loanStats->pengajuan_pending;
        $pinjamanAktif = $loanStats->pinjaman_aktif;
        $totalOutstanding = $loanStats->total_outstanding;

        $pengajuanTerbaru = Loan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return view('pengurus.dashboard.index', compact(
            'simpananBulanIni', 'pengajuanPending', 'pinjamanAktif',
            'totalOutstanding', 'pengajuanTerbaru'
        ));
    }
}
