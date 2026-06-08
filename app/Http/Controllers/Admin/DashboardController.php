<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalAnggota = User::role('anggota')->count();
        $newAnggotaThisMonth = User::role('anggota')->where('join_date', '>=', now()->startOfMonth())->count();
        $totalPengurus = User::role('pengurus')->count();
        $totalPengawas = User::role('pengawas')->count();

        $totalSimpananPokokWajib = Saving::whereIn('type', ['pokok', 'wajib'])->sum('balance');
        $totalSukarelaMasuk = SavingsTransaction::where('type', 'setor')
            ->where('status', 'approved')
            ->sum('amount');
        $totalSukarelaTarik = SavingsTransaction::where('type', 'tarik')
            ->where('status', 'approved')
            ->sum('amount');
        $totalSimpanan = $totalSimpananPokokWajib + $totalSukarelaMasuk - $totalSukarelaTarik;

        $loanStats = Loan::selectRaw("
            COALESCE(SUM(CASE WHEN status IN ('active','paid') THEN amount ELSE 0 END), 0) as total_pinjaman,
            COALESCE(SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END), 0) as pinjaman_aktif,
            COALESCE(SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END), 0) as pengajuan_menunggu,
            COALESCE(SUM(CASE WHEN status IN ('active','paid') THEN total_payment ELSE 0 END), 0) as total_pinjaman_dengan_bunga
        ")->first();

        $totalPinjaman = $loanStats->total_pinjaman;
        $pinjamanAktif = $loanStats->pinjaman_aktif;
        $pengajuanMenunggu = $loanStats->pengajuan_menunggu;
        $totalPinjamanDenganBunga = $loanStats->total_pinjaman_dengan_bunga;
        $persentaseBunga = $totalPinjaman > 0 ? round(($totalPinjamanDenganBunga - $totalPinjaman) / $totalPinjaman * 100, 1) : 0;

        $pendingLoans = Loan::with('user')->where('status', 'pending')->latest()->take(10)->get();
        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        $organization = Organization::first();

        return view('admin.dashboard.index', compact(
            'totalAnggota', 'newAnggotaThisMonth', 'totalPengurus', 'totalPengawas',
            'totalSimpanan', 'totalPinjaman', 'pinjamanAktif',
            'pengajuanMenunggu', 'totalPinjamanDenganBunga', 'persentaseBunga',
            'pendingLoans', 'recentLogs', 'organization'
        ));
    }
}
