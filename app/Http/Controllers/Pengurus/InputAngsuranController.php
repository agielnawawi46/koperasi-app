<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Installment;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InputAngsuranController extends Controller
{
    public function index(): View
    {
        $pinjamanAktif = Loan::with('user')
            ->whereIn('status', ['approved', 'ready_for_disbursement', 'active'])
            ->get();

        $loanList = $pinjamanAktif->map(fn ($l) => [
            'id' => $l->id,
            'loan_number' => $l->loan_number,
            'amount' => $l->amount,
            'status' => $l->status,
            'user' => ['name' => $l->user?->name ?? 'Unknown'],
        ])->values();

        return view('pengurus.inpangsuran.index', compact('pinjamanAktif', 'loanList'));
    }

    public function getDataPinjaman(Loan $loan)
    {
        $angsuran = Installment::where('loan_id', $loan->id)
            ->where('status', 'pending')
            ->orderBy('installment_number')
            ->first();

        $terbayar = Installment::where('loan_id', $loan->id)->where('status', 'paid')->count();
        $sisaAngsuran = Installment::where('loan_id', $loan->id)->where('status', 'pending')->count();

        $terakhirBayar = Installment::where('loan_id', $loan->id)
            ->where('status', 'paid')
            ->latest('paid_date')
            ->first();

        return response()->json([
            'nama' => $loan->user->name,
            'no_pinjaman' => $loan->loan_number,
            'sisa_pinjaman' => Installment::where('loan_id', $loan->id)->where('status', 'pending')->sum('amount'),
            'sisa_angsuran' => $sisaAngsuran,
            'total_angsuran' => Installment::where('loan_id', $loan->id)->count(),
            'terbayar' => $terbayar,
            'terakhir_bayar' => $terakhirBayar?->paid_date?->format('d F Y'),
            'jatuh_tempo' => $angsuran?->due_date?->format('d F Y'),
            'angsuran_ke' => $angsuran?->installment_number,
            'jumlah_setoran' => $angsuran?->amount ?? 0,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|in:transfer_bank,bayar_langsung',
        ]);

        $loan = Loan::findOrFail($request->loan_id);
        $paymentMethod = $request->payment_method ?? 'bayar_langsung';

        $angsuran = Installment::where('loan_id', $loan->id)
            ->where('status', 'pending')
            ->orderBy('installment_number')
            ->first();

        if (! $angsuran) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Semua angsuran sudah lunas.']);
            }

            return back()->with('error', 'Semua angsuran sudah lunas.');
        }

        $angsuran->update([
            'status' => 'paid',
            'paid_date' => now(),
            'payment_method' => $paymentMethod,
        ]);

        $sisaPending = Installment::where('loan_id', $loan->id)
            ->where('status', 'pending')
            ->count();

        if ($sisaPending === 0) {
            $loan->update(['status' => 'paid']);
        }

        ActivityLog::create([
            'user_id' => $request->user()->id,
            'action' => 'input_installment',
            'description' => 'Input angsuran ke-'.$angsuran->installment_number.' untuk '.$loan->loan_number.' via '.$paymentMethod,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Angsuran berhasil dicatat!']);
        }

        return redirect()->route('pengurus.inpangsuran')->with('success', 'Angsuran berhasil dicatat!');
    }
}
