<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelolaPinjamanController extends Controller
{
    public function index(): View
    {
        $totalOutstanding = Loan::whereIn('status', ['approved', 'active'])->sum('total_payment');
        $perluReview = Loan::where('status', 'pending')->count();
        $estimasiCicilan = Loan::whereIn('status', ['approved', 'active'])->sum('monthly_payment');

        $pinjaman = Loan::with('user')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'active', 'rejected', 'paid')")
            ->latest()
            ->get();

        return view('pengurus.kelpinjaman.index', compact(
            'totalOutstanding', 'perluReview', 'estimasiCicilan', 'pinjaman'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:100000',
            'tenure_months' => 'required|integer|min:3|max:60',
            'purpose' => 'nullable|string|max:500',
            'interest_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $organization = Organization::first();
        $bungaRate = $request->interest_rate ?? ($organization?->bunga_rate ?? 0.8);

        $member = \App\Models\User::find($request->user_id);

        // Rule: existing active loan check
        $activeLoan = Loan::where('user_id', $request->user_id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->exists();
        if ($activeLoan) {
            return back()->with('error', 'Anggota masih memiliki pinjaman yang belum diselesaikan.')->withInput();
        }

        // Rule 1: active member check
        if ($organization->require_active_member && $member->status !== 'active') {
            return back()->with('error', 'Hanya anggota aktif yang dapat mengajukan pinjaman.')->withInput();
        }

        // Rule 2: max loan amount check
        $memberSavings = Saving::where('user_id', $request->user_id)->sum('balance');
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
        $maxInstallment = $member->base_salary * ($organization->max_salary_deduction / 100);
        if ($monthlyPayment > $maxInstallment) {
            $formatted = 'Rp ' . number_format($maxInstallment, 0, ',', '.');
            return back()->with('error', "Cicilan bulanan melebihi batas potongan gaji ({$formatted}).")->withInput();
        }

        $loan = Loan::create([
            'loan_number' => 'PJM-'.now()->format('Ymd').'-'.str_pad((string) (Loan::max('id') + 1), 4, '0', STR_PAD_LEFT),
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'interest_rate' => $bungaRate,
            'tenure_months' => $request->tenure_months,
            'monthly_payment' => round($monthlyPayment, 2),
            'total_interest' => $totalBunga,
            'total_payment' => $totalPayment,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'create_loan',
            'description' => 'Membuat pinjaman baru: '.$loan->loan_number,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.kelpinjaman')->with('success', 'Pinjaman berhasil dibuat!');
    }

    public function approve(Loan $loan, Request $request)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Pinjaman sudah diproses.');
        }

        $organization = Organization::first();
        $member = $loan->user;

        // Re-validate all rules at approval time

        // Rule: existing active loan check (excluding current loan)
        $activeLoan = Loan::where('user_id', $member->id)
            ->where('id', '!=', $loan->id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->exists();
        if ($activeLoan) {
            return back()->with('error', 'Anggota masih memiliki pinjaman lain yang belum diselesaikan.');
        }

        // Rule 1: active member check
        if ($organization->require_active_member && $member->status !== 'active') {
            return back()->with('error', 'Anggota tidak aktif, tidak dapat menyetujui pinjaman.');
        }

        // Rule 2: max loan amount check
        $memberSavings = Saving::where('user_id', $member->id)->sum('balance');
        $maxLoanBySavings = $memberSavings * ($organization->max_loan_percentage / 100);
        $maxLoanAmount = $organization->max_loan_amount > 0
            ? min($maxLoanBySavings, $organization->max_loan_amount)
            : $maxLoanBySavings;
        if ($loan->amount > $maxLoanAmount) {
            $formatted = 'Rp ' . number_format($maxLoanAmount, 0, ',', '.');
            return back()->with('error', "Jumlah pinjaman melebihi batas maksimum ({$formatted}).");
        }

        // Rule 3: max tenor check
        if ($loan->tenure_months > $organization->max_tenor) {
            return back()->with('error', 'Tenor pinjaman melebihi batas maksimum ' . $organization->max_tenor . ' bulan.');
        }

        // Rule 4: monthly installment vs salary deduction limit check
        $maxInstallment = $member->base_salary * ($organization->max_salary_deduction / 100);
        if ($loan->monthly_payment > $maxInstallment) {
            $formatted = 'Rp ' . number_format($maxInstallment, 0, ',', '.');
            return back()->with('error', "Cicilan bulanan melebihi batas potongan gaji ({$formatted}).");
        }

        $loan->update([
            'status' => 'approved',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
        ]);

        $this->generateInstallments($loan);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'approve_loan',
            'description' => 'Menyetujui pinjaman: '.$loan->loan_number,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.kelpinjaman')->with('success', 'Pinjaman disetujui!');
    }

    public function reject(Loan $loan, Request $request)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Pinjaman sudah diproses.');
        }

        $loan->update([
            'status' => 'rejected',
            'notes' => $request->notes ?? 'Ditolak oleh pengurus',
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'reject_loan',
            'description' => 'Menolak pinjaman: '.$loan->loan_number,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.kelpinjaman')->with('success', 'Pinjaman ditolak.');
    }

    public function cairkan(Loan $loan, Request $request)
    {
        if ($loan->status !== 'approved') {
            return back()->with('error', 'Pinjaman harus disetujui terlebih dahulu.');
        }

        $loan->update([
            'status' => 'active',
            'disbursed_by' => $request->user()->id,
            'disbursed_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'disburse_loan',
            'description' => 'Mencairkan pinjaman: '.$loan->loan_number,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.kelpinjaman')->with('success', 'Pinjaman berhasil dicairkan!');
    }

    private function generateInstallments(Loan $loan)
    {
        $installments = [];
        $dueDay = min((int) (Organization::first()?->tgl_tagihan ?? 25), 28);

        for ($i = 1; $i <= $loan->tenure_months; $i++) {
            $dueDate = now()->addMonths($i)->setDay($dueDay);

            $remainingPrincipal = $loan->amount - (($i - 1) * ($loan->amount / $loan->tenure_months));
            $monthlyInterest = ($remainingPrincipal * ($loan->interest_rate / 100));
            $monthlyPrincipal = ($loan->amount / $loan->tenure_months);

            $installments[] = [
                'loan_id' => $loan->id,
                'installment_number' => $i,
                'amount' => round($monthlyPrincipal + $monthlyInterest, 2),
                'principal' => round($monthlyPrincipal, 2),
                'interest' => round($monthlyInterest, 2),
                'due_date' => $dueDate,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Installment::insert($installments);
    }
}
