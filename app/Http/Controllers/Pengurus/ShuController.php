<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Installment;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\Shu;
use App\Models\ShuMember;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ShuController extends Controller
{
    public function index(): View
    {
        $organization = Organization::first();
        $years = range(now()->year - 5, now()->year);

        $shuRecords = Shu::withCount('members')
            ->orderBy('year', 'desc')
            ->get();

        $existingYears = $shuRecords->pluck('year')->toArray();

        $allSavings = Saving::sum('balance');
        $allInterestPaid = Installment::where('status', 'paid')
            ->whereYear('paid_date', now()->year)
            ->sum('interest');

        return view('pengurus.shu.index', compact(
            'organization', 'years', 'shuRecords',
            'existingYears', 'allSavings', 'allInterestPaid'
        ));
    }

    public function calculate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|integer|min:2000|max:2099',
            'total_income' => 'required|numeric|min:0',
            'total_expenses' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $year = $request->integer('year');
        $totalIncome = $request->numeric('total_income');
        $totalExpenses = $request->numeric('total_expenses');

        $shuAmount = $totalIncome - $totalExpenses;

        if ($shuAmount < 0) {
            return back()->with('error', 'SHU tidak boleh negatif. Total pendapatan harus lebih besar dari total biaya.')
                ->withInput();
        }

        $exists = Shu::where('year', $year)->exists();
        if ($exists) {
            return back()->with('error', "SHU untuk tahun {$year} sudah ada. Hanya satu periode per tahun.")
                ->withInput();
        }

        $organization = Organization::first();

        $savingsAlloc = $organization->shu_savings_allocation / 100;
        $loanAlloc = $organization->shu_loan_allocation / 100;
        $reserveAlloc = $organization->shu_reserve_allocation / 100;
        $socialAlloc = $organization->shu_social_allocation / 100;

        $reserveFund = $shuAmount * $reserveAlloc;
        $socialFund = $shuAmount * $socialAlloc;
        $distributablePool = $shuAmount - $reserveFund - $socialFund;

        $memberTotal = $savingsAlloc + $loanAlloc;
        $savingsPool = $memberTotal > 0
            ? $distributablePool * ($savingsAlloc / $memberTotal)
            : 0;
        $loanPool = $memberTotal > 0
            ? $distributablePool * ($loanAlloc / $memberTotal)
            : 0;

        $totalMemberSavings = Saving::sum('balance');
        $members = User::all();

        $memberAllocations = [];
        foreach ($members as $member) {
            $memberSavings = Saving::where('user_id', $member->id)->sum('balance');

            $memberInterestPaid = Installment::whereHas('loan', function ($q) use ($member) {
                $q->where('user_id', $member->id);
            })
                ->where('status', 'paid')
                ->whereYear('paid_date', $year)
                ->sum('interest');

            $modalAmount = $totalMemberSavings > 0
                ? ($memberSavings / $totalMemberSavings) * $savingsPool
                : 0;

            $memberAmount = $allInterestPaid > 0
                ? ($memberInterestPaid / $allInterestPaid) * $loanPool
                : 0;

            $totalMemberShu = $modalAmount + $memberAmount;

            if ($totalMemberShu > 0) {
                $memberAllocations[] = [
                    'user_id' => $member->id,
                    'modal_amount' => round($modalAmount, 2),
                    'member_amount' => round($memberAmount, 2),
                    'amount' => round($totalMemberShu, 2),
                ];
            }
        }

        $totalAllocated = collect($memberAllocations)->sum('amount');
        $remainingAmount = $distributablePool - $totalAllocated + $reserveFund + $socialFund;

        DB::beginTransaction();
        try {
            $shu = Shu::create([
                'year' => $year,
                'total_income' => $totalIncome,
                'total_expenses' => $totalExpenses,
                'total_amount' => round($shuAmount, 2),
                'distributed_amount' => round($distributablePool, 2),
                'remaining_amount' => round($remainingAmount, 2),
                'status' => 'open',
                'calculated_at' => now(),
            ]);

            foreach ($memberAllocations as $allocation) {
                ShuMember::create([
                    'shu_id' => $shu->id,
                    'user_id' => $allocation['user_id'],
                    'amount' => $allocation['amount'],
                    'modal_amount' => $allocation['modal_amount'],
                    'member_amount' => $allocation['member_amount'],
                    'status' => 'pending',
                ]);
            }

            ActivityLog::create([
                'user_id' => $request->user()->id,
                'action' => 'calculate_shu',
                'description' => "Menghitung SHU tahun {$year}: Rp " . number_format($shuAmount, 0, ',', '.'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghitung SHU: ' . $e->getMessage());
        }

        return redirect()->route('pengurus.shu')
            ->with('success', "SHU tahun {$year} berhasil dihitung. Total: Rp " . number_format($shuAmount, 0, ',', '.'));
    }

    public function distribute(Shu $shu, Request $request): RedirectResponse
    {
        if ($shu->status !== 'open') {
            return back()->with('error', 'SHU harus berstatus open untuk dapat didistribusikan.');
        }

        if ($shu->members()->count() === 0) {
            return back()->with('error', 'Tidak ada alokasi anggota untuk didistribusikan.');
        }

        DB::beginTransaction();
        try {
            $shu->members()->update(['status' => 'distributed']);

            $shu->update([
                'status' => 'distributed',
            ]);

            ActivityLog::create([
                'user_id' => $request->user()->id,
                'action' => 'distribute_shu',
                'description' => "Mendistribusikan SHU tahun {$shu->year} kepada {$shu->members()->count()} anggota",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mendistribusikan SHU: ' . $e->getMessage());
        }

        return redirect()->route('pengurus.shu')
            ->with('success', "SHU tahun {$shu->year} berhasil didistribusikan kepada anggota.");
    }

    public function close(Shu $shu, Request $request): RedirectResponse
    {
        if ($shu->status !== 'distributed') {
            return back()->with('error', 'SHU harus berstatus distributed sebelum dapat ditutup.');
        }

        $shu->update(['status' => 'closed']);

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'close_shu',
            'description' => "Menutup periode SHU tahun {$shu->year}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('pengurus.shu')
            ->with('success', "Periode SHU tahun {$shu->year} berhasil ditutup.");
    }
}
