<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PinjamanController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $pinjamanAktif = Loan::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'ready_for_disbursement', 'active'])
            ->first();

        $sisaHutang = 0;
        $sisaAngsuran = 0;
        $progressPercent = 0;
        $angsuranBulanIni = 0;
        $jatuhTempo = null;
        $pokok = 0;
        $jasa = 0;
        $estimasiBulanan = 0;

        if ($pinjamanAktif) {
            $totalAngsuran = Installment::where('loan_id', $pinjamanAktif->id)->count();
            $terbayar = Installment::where('loan_id', $pinjamanAktif->id)->where('status', 'paid')->count();
            $sisaAngsuran = $totalAngsuran - $terbayar;
            $progressPercent = $totalAngsuran > 0 ? round(($terbayar / $totalAngsuran) * 100) : 0;

            $angsuranBerikutnya = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->orderBy('installment_number')
                ->first();

            if ($angsuranBerikutnya) {
                $angsuranBulanIni = $angsuranBerikutnya->amount;
                $jatuhTempo = $angsuranBerikutnya->due_date;
                $pokok = $angsuranBerikutnya->principal;
                $jasa = $angsuranBerikutnya->interest;
            }

            $sisaHutang = Installment::where('loan_id', $pinjamanAktif->id)
                ->where('status', 'pending')
                ->sum('amount');

            $estimasiBulanan = $pinjamanAktif->monthly_payment;
        }

        $riwayatPinjaman = Loan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('anggota.pinjaman.index', compact(
            'sisaHutang', 'sisaAngsuran', 'progressPercent',
            'angsuranBulanIni', 'jatuhTempo', 'pokok', 'jasa',
            'estimasiBulanan', 'pinjamanAktif', 'riwayatPinjaman'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100000',
            'purpose' => 'required|string|max:500',
            'tenure_months' => 'required|integer|min:3|max:60',
            'payment_method' => 'nullable|string|in:transfer_bank,bayar_langsung',
        ]);

        $user = Auth::user();
        $organization = Organization::first();
        $bungaRate = $organization?->bunga_rate ?? 0.8;

        // Rule: existing active loan check
        $activeLoan = Loan::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'ready_for_disbursement', 'active'])
            ->exists();
        if ($activeLoan) {
            return back()->with('error', 'Anda masih memiliki pinjaman yang belum diselesaikan.')->withInput();
        }

        // Rule 1: active member check
        if ($organization->require_active_member && $user->status !== 'active') {
            return back()->with('error', 'Hanya anggota aktif yang dapat mengajukan pinjaman.')->withInput();
        }

        // Rule 2: max loan amount check
        $memberSavings = Saving::where('user_id', $user->id)->sum('balance');
        $maxLoanBySavings = $memberSavings * ($organization->max_loan_percentage / 100);
        $maxLoanAmount = $organization->max_loan_amount > 0
            ? min($maxLoanBySavings, $organization->max_loan_amount)
            : $maxLoanBySavings;
        if ($request->amount > $maxLoanAmount) {
            $formatted = 'Rp ' . number_format($maxLoanAmount, 0, ',', '.');
            return back()->with('error', "Jumlah pinjaman melebihi batas maksimum ({$formatted}).")->withInput();
        }

        // Rule 3: max tenor check
        if ($request->tenure_months > $organization->max_tenor) {
            return back()->with('error', 'Tenor pinjaman melebihi batas maksimum ' . $organization->max_tenor . ' bulan.')->withInput();
        }

        $totalBunga = $request->amount * ($bungaRate / 100) * $request->tenure_months;
        $totalPayment = $request->amount + $totalBunga;
        $monthlyPayment = $totalPayment / $request->tenure_months;

        // Rule 4: monthly installment vs salary deduction limit check
        $maxInstallment = $user->base_salary * ($organization->max_salary_deduction / 100);
        if ($monthlyPayment > $maxInstallment) {
            $formatted = 'Rp ' . number_format($maxInstallment, 0, ',', '.');
            return back()->with('error', "Cicilan bulanan melebihi batas potongan gaji ({$formatted}).")->withInput();
        }

        $loan = Loan::create([
            'loan_number' => 'PJM-'.now()->format('Ymd').'-'.str_pad((string) (Loan::max('id') + 1), 4, '0', STR_PAD_LEFT),
            'user_id' => $user->id,
            'amount' => $request->amount,
            'interest_rate' => $bungaRate,
            'tenure_months' => $request->tenure_months,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_interest' => $totalBunga,
            'total_payment' => $totalPayment,
            'purpose' => $request->purpose,
            'payment_method' => $request->payment_method ?? 'transfer_bank',
            'status' => 'pending',
        ]);

        return redirect()->route('anggota.pinjaman')->with('success', 'Pengajuan pinjaman berhasil dikirim!');
    }
}
