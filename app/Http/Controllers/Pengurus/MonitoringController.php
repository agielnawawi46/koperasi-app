<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Loan;
use App\Models\SavingsTransaction;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function index(): View
    {
        $transaksiHariIni = SavingsTransaction::whereDate('created_at', now()->today())->count()
            + \App\Models\Installment::whereDate('paid_date', now()->today())->count();

        $kemarin = SavingsTransaction::whereDate('created_at', now()->subDay())->count()
            + \App\Models\Installment::whereDate('paid_date', now()->subDay())->count();

        $growthPersen = $kemarin > 0 ? round((($transaksiHariIni - $kemarin) / $kemarin) * 100) : 0;

        $pengajuanPending = Loan::where('status', 'pending')->count();

        $aktivitas = ActivityLog::with('user')
            ->latest()
            ->take(20)
            ->get()
            ->map(function ($log) {
                return [
                    'waktu' => $log->created_at->format('H:i'),
                    'inisial' => strtoupper(substr($log->user?->name ?? 'S', 0, 2)),
                    'nama' => $log->user?->name ?? 'Sistem',
                    'jenis' => str_contains($log->action, 'saving') || str_contains($log->action, 'simpanan') ? 'Simpanan' : 'Pinjaman',
                    'aktivitas' => $log->description ?? $log->action,
                    'status' => 'Berhasil',
                ];
            });

        return view('pengurus.monitoring.index', compact(
            'transaksiHariIni', 'growthPersen', 'pengajuanPending', 'aktivitas'
        ));
    }
}
