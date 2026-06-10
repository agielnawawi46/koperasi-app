<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Payroll;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\Shu;
use App\Models\ShuMember;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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

        $semuaTransaksi = collect();

        $transaksi = SavingsTransaction::with('savingAccount.user')
            ->whereDate('created_at', $tanggal)
            ->latest()
            ->take(50)
            ->get()
            ->map(function ($t) {
                return [
                    'tanggal' => $t->created_at->format('d/m/Y H:i'),
                    'id_transaksi' => 'TRX-' . str_pad((string) $t->id, 6, '0', STR_PAD_LEFT),
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
                    'id_transaksi' => 'ANG-' . str_pad((string) $t->id, 6, '0', STR_PAD_LEFT),
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

    public function getData(Request $request): JsonResponse
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

        $totalAnggota = User::role('anggota')->count();
        $totalSimpanan = Saving::sum('balance');
        $totalOutstanding = Loan::whereIn('status', ['approved', 'ready_for_disbursement', 'active'])->sum('total_payment');

        $pendingSimpanan = SavingsTransaction::with(['user', 'savingAccount'])
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($t) {
                return [
                    'id' => $t->id,
                    'anggota' => $t->user?->name ?? '-',
                    'jenis' => $t->savingAccount?->type ?? '-',
                    'nominal' => (int) $t->amount,
                    'tanggal' => $t->created_at->format('d/m/Y H:i'),
                    'metode' => $t->payment_method ?? '-',
                ];
            });

        $pendingPinjaman = Loan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($l) {
                return [
                    'id' => $l->id,
                    'no_pinjaman' => $l->loan_number,
                    'anggota' => $l->user?->name ?? '-',
                    'jumlah' => (int) $l->amount,
                    'tenor' => $l->tenure_months . ' bln',
                    'tanggal' => $l->created_at->format('d/m/Y'),
                ];
            });

        $angsuranHariIni = Installment::with('loan.user')
            ->whereDate('paid_date', $tanggal)
            ->where('status', 'paid')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($i) {
                return [
                    'id' => $i->id,
                    'anggota' => $i->loan?->user?->name ?? '-',
                    'no_pinjaman' => $i->loan?->loan_number ?? '-',
                    'angsuran_ke' => $i->installment_number,
                    'nominal' => (int) $i->amount,
                    'metode' => $i->payment_method ?? '-',
                ];
            });

        $payrollBulanIni = Payroll::with('user')
            ->where('period_month', $tanggal->month)
            ->where('period_year', $tanggal->year)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'anggota' => $p->user?->name ?? '-',
                    'gaji_pokok' => (int) $p->base_salary,
                    'tunjangan' => (int) $p->allowance,
                    'potongan' => (int) ($p->wajib_deduction + $p->other_deduction),
                    'gaji_bersih' => (int) $p->net_salary,
                    'status' => $p->status,
                ];
            });

        $payrollCounts = [
            'pending' => Payroll::where('period_month', $tanggal->month)
                ->where('period_year', $tanggal->year)
                ->where('status', 'pending')->count(),
            'processed' => Payroll::where('period_month', $tanggal->month)
                ->where('period_year', $tanggal->year)
                ->where('status', 'processed')->count(),
            'paid' => Payroll::where('period_month', $tanggal->month)
                ->where('period_year', $tanggal->year)
                ->where('status', 'paid')->count(),
        ];

        $shuTahunIni = Shu::with(['members.user'])
            ->where('year', $tanggal->year)
            ->get()
            ->map(function ($s) {
                return [
                    'id' => $s->id,
                    'tahun' => $s->year,
                    'total' => (int) $s->total_amount,
                    'terdistribusi' => (int) $s->distributed_amount,
                    'sisa' => (int) $s->remaining_amount,
                    'status' => $s->status,
                    'anggota' => $s->members->count(),
                    'terdistribusi_anggota' => $s->members->where('status', 'distributed')->count(),
                ];
            });

        return response()->json([
            'summary' => [
                'pemasukan' => (int) $pemasukanHariIni,
                'penyaluran' => (int) $penyaluranHariIni,
                'total_transaksi' => $totalTransaksi,
                'net_profit' => (int) max(0, $netProfit),
                'total_anggota' => $totalAnggota,
                'total_simpanan' => (int) $totalSimpanan,
                'total_outstanding' => (int) $totalOutstanding,
            ],
            'simpanan' => [
                'pending' => $pendingSimpanan,
                'total_pending' => SavingsTransaction::where('status', 'pending')->count(),
            ],
            'pinjaman' => [
                'pending' => $pendingPinjaman,
                'total_pending' => Loan::where('status', 'pending')->count(),
            ],
            'angsuran' => [
                'hari_ini' => $angsuranHariIni,
                'total_hari_ini' => Installment::whereDate('paid_date', $tanggal)->where('status', 'paid')->count(),
            ],
            'payroll' => [
                'data' => $payrollBulanIni,
                'counts' => $payrollCounts,
            ],
            'shu' => $shuTahunIni,
        ]);
    }
}
