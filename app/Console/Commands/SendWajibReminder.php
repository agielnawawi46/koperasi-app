<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Console\Command;

class SendWajibReminder extends Command
{
    protected $signature = 'app:send-wajib-reminder';

    protected $description = 'Send reminder notifications for wajib savings due date';

    public function handle()
    {
        $org = Organization::first();

        if (! $org) {
            $this->error('Organisasi belum dikonfigurasi.');

            return 1;
        }

        if ($org->payment_method !== 'Transfer Manual') {
            $this->info('Metode pembayaran bukan Transfer Manual. Lewati.');

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
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'wajib_reminder',
                'description' => 'Pengingat: Simpanan wajib Rp '.number_format($wajibAmount).' bulan '.now()->translatedFormat('F Y')." harus dibayar sebelum tgl {$tagihanDay}",
                'ip_address' => 'system',
                'user_agent' => 'System Scheduler',
            ]);

            $count++;
        }

        $this->info("Pengingat simpanan wajib dikirim untuk {$count} anggota.");

        return 0;
    }
}
