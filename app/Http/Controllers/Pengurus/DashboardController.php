<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Saving;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $simpananBulanIni = Saving::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('balance');

        $pengajuanPending = Loan::where('status', 'pending')->count();

        $pinjamanAktif = Loan::whereIn('status', ['active', 'approved'])->count();
        $totalOutstanding = Loan::whereIn('status', ['active', 'approved'])->sum('total_payment');

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
