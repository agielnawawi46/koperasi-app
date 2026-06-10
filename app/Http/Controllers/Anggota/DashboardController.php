<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $organization = Organization::first();

        $pokokAmount = $organization?->pokok_amount ?? 0;
        $wajibAmount = $organization?->wajib_amount ?? 0;

        $savings = Saving::where('user_id', $user->id)->whereIn('type', ['pokok', 'wajib'])->get()->keyBy('type');
        $pokokBalance = $savings->get('pokok')?->balance ?? 0;
        $wajibBalance = $savings->get('wajib')?->balance ?? 0;

        $sukarelaTotals = SavingsTransaction::where('user_id', $user->id)
            ->where('status', 'approved')
            ->selectRaw("
                COALESCE(SUM(CASE WHEN type = 'setor' THEN amount ELSE 0 END), 0) as total_masuk,
                COALESCE(SUM(CASE WHEN type = 'tarik' THEN amount ELSE 0 END), 0) as total_keluar
            ")->first();

        $sukarelaMasuk = $sukarelaTotals->total_masuk;
        $sukarelaKeluar = $sukarelaTotals->total_keluar;
        $sukarelaBalance = $sukarelaMasuk - $sukarelaKeluar;

        $totalSimpanan = $pokokBalance + $wajibBalance + $sukarelaBalance;

        $pinjamanAktif = Loan::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'ready_for_disbursement', 'active'])
            ->first();

        $tagihanBulanIni = 0;
        $sisaAngsuran = 0;
        $totalPinjaman = 0;
        $jatuhTempo = null;

        if ($pinjamanAktif) {
            $angsuran = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->orderBy('installment_number')
                ->first();

            $tagihanBulanIni = $angsuran?->amount ?? 0;
            $jatuhTempo = $angsuran?->due_date;
            $sisaAngsuran = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->count();
            $totalPinjaman = $pinjamanAktif->amount;
        }

        $bankName = $organization?->bank_name;
        $bankAccountName = $organization?->bank_account_name;
        $bankAccountNumber = $organization?->bank_account_number;

        $riwayatTransaksi = Installment::where('status', 'paid')
            ->whereIn('loan_id', Loan::where('user_id', $user->id)->pluck('id'))
            ->latest()
            ->take(5)
            ->get();

        return view('anggota.dashboard.index', compact(
            'totalSimpanan', 'totalPinjaman', 'tagihanBulanIni',
            'sisaAngsuran', 'pinjamanAktif', 'riwayatTransaksi',
            'pokokBalance', 'wajibBalance', 'sukarelaBalance',
            'pokokAmount', 'wajibAmount',
            'jatuhTempo', 'bankName', 'bankAccountName', 'bankAccountNumber',
        ));
    }
}
