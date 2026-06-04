<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Saving;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $simpanan = Saving::where('user_id', $user->id)->get();
        $totalSimpanan = $simpanan->sum('balance');

        $pinjamanAktif = Loan::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'active'])
            ->first();

        $tagihanBulanIni = 0;
        $sisaAngsuran = 0;
        $totalPinjaman = 0;

        if ($pinjamanAktif) {
            $angsuran = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->orderBy('installment_number')
                ->first();

            $tagihanBulanIni = $angsuran?->amount ?? 0;
            $sisaAngsuran = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->count();
            $totalPinjaman = $pinjamanAktif->amount;
        }

        $riwayatTransaksi = Installment::whereHas('loan', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'paid')->latest()->take(5)->get();

        return view('anggota.dashboard.index', compact(
            'totalSimpanan', 'totalPinjaman', 'tagihanBulanIni',
            'sisaAngsuran', 'pinjamanAktif', 'riwayatTransaksi'
        ));
    }
}
