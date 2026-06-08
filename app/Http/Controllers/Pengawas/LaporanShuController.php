<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\SavingsTransaction;
use App\Models\Shu;
use App\Models\ShuMember;
use Illuminate\View\View;

class LaporanShuController extends Controller
{
    public function index(): View
    {
        $shuBerjalan = Shu::where('year', now()->year)->sum('total_amount');
        $pendapatanOperasional = Loan::whereIn('status', ['active', 'paid'])->sum('total_interest');
        $bebanOrganisasi = 0;

        $shuTerakhir = Shu::latest('year')->first();
        $statusAudit = $shuTerakhir?->status ?? 'Belum Diaudit';

        $transaksiBulanan = collect(range(1, now()->month))->map(function ($bulan) {
            $tgl = now()->setMonth($bulan);
            $total = SavingsTransaction::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tgl->year)
                ->where('type', 'credit')
                ->sum('amount');

            return [
                'bulan' => $tgl->format('F Y'),
                'total' => $total,
            ];
        });

        $transaksiTahunan = Shu::orderBy('year')->get()->map(function ($shu) {
            return [
                'tahun' => $shu->year,
                'total_pendapatan' => $shu->total_amount,
                'total_shu' => $shu->distributed_amount,
                'status_audit' => $shu->status === 'distributed' ? 'Sudah Diaudit' : 'Menunggu',
            ];
        });

        $transaksiTerkini = ShuMember::with('shu', 'user')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($member) {
                return [
                    'tanggal' => $member->created_at->format('d M Y'),
                    'kategori' => 'SHU',
                    'deskripsi' => 'Distribusi SHU '.($member->shu?->year ?? '-').' - '.($member->user?->name ?? '-'),
                    'nominal' => $member->amount,
                    'status' => $member->status === 'distributed' ? 'Terverifikasi' : 'Pending',
                ];
            });

        $totalTransaksi = ShuMember::count();
        $ditampilkan = min(10, $totalTransaksi);

        return view('pengawas.laporannshu.index', compact(
            'shuBerjalan', 'pendapatanOperasional', 'bebanOrganisasi',
            'statusAudit', 'transaksiBulanan', 'transaksiTahunan',
            'transaksiTerkini', 'totalTransaksi', 'ditampilkan'
        ));
    }
}
