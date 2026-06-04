<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use Illuminate\View\View;

class AuditSimpananController extends Controller
{
    public function index(): View
    {
        $totalKasSimpanan = Saving::sum('balance');

        $kategoriSimpanan = [
            ['name' => 'Simpanan Pokok', 'total' => Saving::where('type', 'pokok')->sum('balance')],
            ['name' => 'Simpanan Wajib', 'total' => Saving::where('type', 'wajib')->sum('balance')],
            ['name' => 'Simpanan Sukarela', 'total' => Saving::where('type', 'sukarela')->sum('balance')],
        ];

        $logMutasi = SavingsTransaction::with('saving.user')
            ->latest()
            ->take(50)
            ->get()
            ->map(function ($trx) {
                return [
                    'anggota' => $trx->user->name ?? $trx->saving?->user?->name ?? '-',
                    'jenis' => $trx->saving?->type ?? '-',
                    'nominal' => $trx->amount,
                    'audit_status' => 'Terverifikasi',
                ];
            });

        return view('pengawas.audsimpanan.index', compact(
            'totalKasSimpanan', 'kategoriSimpanan', 'logMutasi'
        ));
    }
}
