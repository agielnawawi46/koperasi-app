<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\Console\Command;

class AutoWajibDeduction extends Command
{
    protected $signature = 'app:auto-wajib-deduction';

    protected $description = 'Auto-create simpanan wajib for all active anggota based on payment method';

    public function handle()
    {
        $org = Organization::first();

        if (! $org) {
            $this->error('Organisasi belum dikonfigurasi.');

            return 1;
        }

        if ($org->payment_method !== 'Potong Gaji') {
            $this->info('Metode pembayaran bukan Potong Gaji. Lewati.');

            return 0;
        }

        $wajibAmount = $org->wajib_amount;
        $tagihanDay = (int) $org->tgl_tagihan;

        $today = now()->day;
        if ($today !== $tagihanDay) {
            $this->info("Hari ini bukan tanggal tagihan (tgl {$tagihanDay}). Lewati.");

            return 0;
        }

        $anggota = User::role('anggota')->where('status', 'active')->get();

        $count = 0;
        foreach ($anggota as $user) {
            $saving = Saving::firstOrCreate(
                ['user_id' => $user->id, 'type' => 'wajib'],
                ['balance' => 0]
            );

            $saving->increment('balance', $wajibAmount);

            SavingsTransaction::create([
                'saving_id' => $saving->id,
                'user_id' => $user->id,
                'type' => 'setor',
                'amount' => $wajibAmount,
                'description' => 'Simpanan wajib otomatis bulan '.now()->translatedFormat('F Y'),
                'transaction_date' => now(),
                'status' => 'approved',
                'payment_method' => 'potong_gaji',
                'verified_at' => now(),
            ]);

            $count++;
        }

        $this->info("Berhasil memproses simpanan wajib untuk {$count} anggota.");

        return 0;
    }
}
