<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SimpananController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $organization = Organization::first();

        $pokokAmount = $organization?->pokok_amount ?? 500000;

        $simpananPokok = Saving::firstOrCreate(
            ['user_id' => $user->id, 'type' => 'pokok'],
            ['balance' => $pokokAmount]
        );

        $simpananWajib = Saving::firstOrCreate(
            ['user_id' => $user->id, 'type' => 'wajib'],
            ['balance' => 0]
        );

        $simpananSukarelaApproved = SavingsTransaction::where('user_id', $user->id)
            ->where('type', 'setor')
            ->where('status', 'approved')
            ->sum('amount');
        $simpananSukarelaTarik = SavingsTransaction::where('user_id', $user->id)
            ->where('type', 'tarik')
            ->where('status', 'approved')
            ->sum('amount');
        $saldoSukarela = $simpananSukarelaApproved - $simpananSukarelaTarik;

        $riwayat = SavingsTransaction::where('user_id', $user->id)
            ->with('savingAccount')
            ->latest('transaction_date')
            ->get();

        $pokok = $simpananPokok->balance;
        $wajib = $simpananWajib->balance;

        $paymentMethod = $organization?->payment_method ?? 'Transfer Manual';
        $wajibAmount = $organization?->wajib_amount ?? 0;
        $tglTagihan = $organization?->tgl_tagihan ?? 25;

        return view('anggota.simpanan.index', [
            'namaKoperasi' => $organization?->name ?? 'Koperasi',
            'totalSaldo' => $pokok + $wajib + $saldoSukarela,
            'statusAnggota' => $user->status === 'active' ? 'Aktif' : 'Nonaktif',
            'memberCode' => $user->member_code ?? 'KOP-'.str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'joinDate' => $user->join_date?->format('F Y') ?? now()->format('F Y'),
            'bankName' => $organization?->bank_name,
            'bankAccountName' => $organization?->bank_account_name,
            'bankAccountNumber' => $organization?->bank_account_number,
            'wajib' => $wajib,
            'wajibAmount' => $wajibAmount,
            'paymentMethod' => $paymentMethod,
            'tglTagihan' => $tglTagihan,
            'pokok' => $pokok,
            'saldoSukarela' => $saldoSukarela,
            'riwayat' => $riwayat,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1000',
            'metode' => 'required|string|in:Transfer Bank (Manual),Potong Gaji (Bulan Depan),Transfer Bank,Bayar Langsung',
        ]);

        $user = auth()->user();
        $type = $request->input('type', 'sukarela');

        if ($type === 'wajib') {
            $simpanan = Saving::firstOrCreate(
                ['user_id' => $user->id, 'type' => 'wajib'],
                ['balance' => 0]
            );

            $isTransferBank = $request->metode === 'Transfer Bank';
            $paymentMethod = $isTransferBank ? 'transfer_bank' : 'bayar_langsung';

            $transaction = SavingsTransaction::create([
                'saving_id' => $simpanan->id,
                'user_id' => $user->id,
                'type' => 'setor',
                'amount' => $request->nominal,
                'transaction_date' => now(),
                'status' => $isTransferBank ? 'approved' : 'pending',
                'payment_method' => $paymentMethod,
                'verified_at' => $isTransferBank ? now() : null,
                'description' => 'Pembayaran simpanan wajib via '.($isTransferBank ? 'Transfer Bank' : 'Bayar Langsung'),
            ]);

            if ($isTransferBank) {
                $simpanan->increment('balance', $request->nominal);

                $msg = 'Pembayaran simpanan wajib via transfer bank berhasil! Saldo otomatis bertambah.';
            } else {
                $msg = 'Pembayaran simpanan wajib via bayar langsung berhasil diajukan. Silakan konfirmasi ke pengurus.';
            }

            return redirect()->route('anggota.simpanan')->with('success', $msg);
        }

        // Sukarela
        $simpananSukarela = Saving::firstOrCreate(
            ['user_id' => $user->id, 'type' => 'sukarela'],
            ['balance' => 0]
        );

        $isTransferBank = $request->metode === 'Transfer Bank (Manual)';
        $paymentMethod = $isTransferBank ? 'transfer_bank' : 'potong_gaji';

        $transaction = SavingsTransaction::create([
            'saving_id' => $simpananSukarela->id,
            'user_id' => $user->id,
            'type' => 'setor',
            'amount' => $request->nominal,
            'transaction_date' => now(),
            'status' => $isTransferBank ? 'pending' : 'pending',
            'payment_method' => $paymentMethod,
            'description' => 'Setoran sukarela via '.$request->metode,
        ]);

        $msg = $request->metode === 'Transfer Bank (Manual)'
            ? 'Setoran berhasil diajukan. Silakan transfer ke rekening koperasi dan konfirmasi ke pengurus.'
            : 'Setoran potong gaji berhasil diajukan. Menunggu konfirmasi pengurus.';

        return redirect()->route('anggota.simpanan')->with('success', $msg);
    }
}
