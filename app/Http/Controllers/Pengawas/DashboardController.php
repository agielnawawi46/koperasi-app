<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\SavingsTransaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalTransaksiSelesai = SavingsTransaction::count() + Installment::count();

        $laporanBulananAktif = now()->format('F Y');

        $sistemStatus = 'Normal';

        $totalSimpanan = \App\Models\Saving::sum('balance');
        $totalPinjaman = Loan::whereIn('status', ['active', 'approved'])->sum('amount');

        return view('pengawas.dashboard.index', compact(
            'totalTransaksiSelesai', 'laporanBulananAktif', 'sistemStatus',
            'totalSimpanan', 'totalPinjaman'
        ));
    }
}
