<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\SavingsTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanHarianController extends Controller
{
    public function index(Request $request): View
    {
        $tanggal = $request->date ? now()->parse($request->date) : now();

        $pemasukanHariIni = SavingsTransaction::whereDate('created_at', $tanggal)
            ->where('type', 'credit')
            ->sum('amount');

        $penyaluranHariIni = Installment::whereDate('paid_date', $tanggal)
            ->where('status', 'paid')
            ->sum('amount');

        $totalTransaksi = SavingsTransaction::whereDate('created_at', $tanggal)->count()
            + Installment::whereDate('paid_date', $tanggal)->count();

        $netProfit = $pemasukanHariIni - $penyaluranHariIni;

        $transaksi = SavingsTransaction::with('saving.user')
            ->whereDate('created_at', $tanggal)
            ->latest()
            ->take(50)
            ->get()
            ->map(function ($t) {
                return [
                    'tanggal' => $t->created_at->format('d/m/Y H:i'),
                    'id_transaksi' => 'TRX-' . str_pad((string)$t->id, 6, '0', STR_PAD_LEFT),
                    'keterangan' => $t->description ?? 'Transaksi simpanan',
                    'kategori' => 'pemasukan',
                    'nominal' => $t->amount,
                ];
            });

        $penyaluranTransaksi = Installment::with('loan.user')
            ->whereDate('paid_date', $tanggal)
            ->where('status', 'paid')
            ->latest()
            ->take(50)
            ->get()
            ->map(function ($t) {
                return [
                    'tanggal' => $t->paid_date?->format('d/m/Y H:i') ?? '-',
                    'id_transaksi' => 'ANG-' . str_pad((string)$t->id, 6, '0', STR_PAD_LEFT),
                    'keterangan' => 'Angsuran ke-' . $t->installment_number . ' (' . $t->loan?->loan_number . ')',
                    'kategori' => 'penyaluran',
                    'nominal' => $t->amount,
                ];
            });

        $semuaTransaksi = $transaksi->concat($penyaluranTransaksi)->sortByDesc('tanggal')->values();

        return view('pengurus.lapharian.index', compact(
            'pemasukanHariIni', 'penyaluranHariIni', 'totalTransaksi',
            'netProfit', 'semuaTransaksi', 'tanggal'
        ));
    }
}
