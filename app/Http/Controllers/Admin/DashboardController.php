<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalAnggota = User::role('anggota')->count();
        $totalPengurus = User::role('pengurus')->count();
        $totalPengawas = User::role('pengawas')->count();

        $totalSimpanan = Saving::sum('balance');
        $totalPinjaman = Loan::whereIn('status', ['active', 'paid'])->sum('amount');
        $pinjamanAktif = Loan::where('status', 'active')->count();
        $pengajuanMenunggu = Loan::where('status', 'pending')->count();

        $totalPinjamanDenganBunga = Loan::whereIn('status', ['active', 'paid'])->sum('total_payment');
        $persentaseBunga = $totalPinjaman > 0 ? round(($totalPinjamanDenganBunga - $totalPinjaman) / $totalPinjaman * 100, 1) : 0;

        $pendingLoans = Loan::with('user')->where('status', 'pending')->latest()->take(10)->get();
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        $organization = Organization::first();

        return view('admin.dashboard.index', compact(
            'totalAnggota', 'totalPengurus', 'totalPengawas',
            'totalSimpanan', 'totalPinjaman', 'pinjamanAktif',
            'pengajuanMenunggu', 'totalPinjamanDenganBunga', 'persentaseBunga',
            'pendingLoans', 'recentLogs', 'organization'
        ));
    }
}
