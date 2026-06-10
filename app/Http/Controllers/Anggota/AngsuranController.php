<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AngsuranController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $pinjamanAktif = Loan::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'ready_for_disbursement', 'active'])
            ->first();

        $tagihanBulanIni = 0;
        $jatuhTempo = null;
        $progresBulan = 0;
        $totalBulan = 0;
        $progressPercent = 0;
        $sisaBulan = 0;
        $totalTerbayar = 0;
        $jadwalAngsuran = collect();
        $pinjamanAktifId = null;

        if ($pinjamanAktif) {
            $pinjamanAktifId = $pinjamanAktif->loan_number;
            $jadwalAngsuran = Installment::where('loan_id', $pinjamanAktif->id)
                ->orderBy('installment_number')
                ->get();

            $totalBulan = $jadwalAngsuran->count();
            $terbayar = $jadwalAngsuran->where('status', 'paid')->count();
            $progresBulan = $terbayar;
            $sisaBulan = $totalBulan - $terbayar;
            $progressPercent = $totalBulan > 0 ? round(($terbayar / $totalBulan) * 100) : 0;
            $totalTerbayar = $jadwalAngsuran->where('status', 'paid')->sum('amount');

            $angsuranSekarang = $jadwalAngsuran->where('status', 'pending')->first();
            if ($angsuranSekarang) {
                $tagihanBulanIni = $angsuranSekarang->amount;
                $jatuhTempo = $angsuranSekarang->due_date;
            }
        }

        $organization = Organization::first();
        $bankName = $organization?->bank_name;
        $bankAccountName = $organization?->bank_account_name;
        $bankAccountNumber = $organization?->bank_account_number;

        return view('anggota.angsuran.index', compact(
            'tagihanBulanIni', 'jatuhTempo', 'progresBulan', 'totalBulan',
            'progressPercent', 'sisaBulan', 'totalTerbayar',
            'jadwalAngsuran', 'pinjamanAktifId', 'pinjamanAktif',
            'bankName', 'bankAccountName', 'bankAccountNumber'
        ));
    }

    public function bayar(Request $request)
    {
        $request->validate([
            'installment_id' => 'required|exists:installments,id',
            'payment_method' => 'nullable|string|in:saldo_sukarela,transfer_bank,bayar_langsung',
        ]);

        $user = Auth::user();
        $installment = Installment::with('loan')->findOrFail($request->installment_id);
        $paymentMethod = $request->payment_method ?? 'saldo_sukarela';

        if ($installment->loan->user_id !== $user->id) {
            return back()->with('error', 'Akses ditolak.');
        }

        if ($installment->status === 'paid') {
            return back()->with('error', 'Angsuran sudah dibayar.');
        }

        if ($paymentMethod === 'saldo_sukarela') {
            $saving = Saving::firstOrCreate(
                ['user_id' => $user->id, 'type' => 'sukarela'],
                ['balance' => 0]
            );

            if ($saving->balance < $installment->amount) {
                return back()->with('error', 'Saldo sukarela tidak mencukupi.');
            }

            $saving->decrement('balance', $installment->amount);

            SavingsTransaction::create([
                'saving_id' => $saving->id,
                'user_id' => $user->id,
                'type' => 'debit',
                'amount' => $installment->amount,
                'payment_method' => $paymentMethod,
                'description' => 'Pembayaran angsuran ke-'.$installment->installment_number,
            ]);

            $installment->update([
                'status' => 'paid',
                'paid_date' => now(),
                'payment_method' => $paymentMethod,
            ]);
        } elseif ($paymentMethod === 'transfer_bank') {
            $installment->update([
                'status' => 'paid',
                'paid_date' => now(),
                'payment_method' => 'transfer_bank',
            ]);

            SavingsTransaction::create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => $installment->amount,
                'status' => 'approved',
                'payment_method' => 'transfer_bank',
                'verified_at' => now(),
                'description' => 'Pembayaran angsuran ke-'.$installment->installment_number.' via Transfer Bank',
            ]);
        } else {
            $installment->update([
                'payment_method' => 'bayar_langsung',
            ]);

            return redirect()->route('anggota.angsuran')->with('success', 'Pembayaran angsuran via bayar langsung diajukan. Silakan konfirmasi ke pengurus.');
        }

        $semuaLunas = Installment::where('loan_id', $installment->loan_id)
            ->where('status', 'pending')
            ->doesntExist();

        if ($semuaLunas) {
            $installment->loan()->update(['status' => 'paid']);
        }

        return redirect()->route('anggota.angsuran')->with('success', 'Pembayaran angsuran berhasil!');
    }
}
