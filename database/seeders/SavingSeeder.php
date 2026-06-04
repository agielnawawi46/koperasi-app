<?php

namespace Database\Seeders;

use App\Models\Saving;
use App\Models\SavingsTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class SavingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('anggota')->get();

        foreach ($users as $user) {
            $pokok = Saving::create([
                'user_id' => $user->id,
                'type' => 'pokok',
                'balance' => 500000,
            ]);

            $now = $user->join_date ?? now()->subMonths(12);
            SavingsTransaction::create([
                'saving_id' => $pokok->id,
                'user_id' => $user->id,
                'type' => 'setor',
                'amount' => 500000,
                'description' => 'Setoran awal simpanan pokok',
                'transaction_date' => $now,
                'reference' => 'TRX-'.$user->member_code.'-POKOK-001',
            ]);

            $monthsSinceJoin = max(1, (int) now()->diffInMonths($now));
            $wajibBalance = $monthsSinceJoin * 100000;

            $wajib = Saving::create([
                'user_id' => $user->id,
                'type' => 'wajib',
                'balance' => $wajibBalance,
            ]);

            for ($m = 1; $m <= min($monthsSinceJoin, 12); $m++) {
                $txDate = $now->copy()->addMonths($m - 1);
                if ($txDate->isFuture()) {
                    continue;
                }

                SavingsTransaction::create([
                    'saving_id' => $wajib->id,
                    'user_id' => $user->id,
                    'type' => 'setor',
                    'amount' => 100000,
                    'description' => 'Simpanan wajib bulan '.$txDate->format('F Y'),
                    'transaction_date' => $txDate,
                    'reference' => 'TRX-'.$user->member_code.'-WJB-'.str_pad((string) $m, 3, '0', STR_PAD_LEFT),
                ]);
            }

            if (fake()->boolean(60)) {
                $sukarelaBalance = fake()->numberBetween(100000, 2000000);
                Saving::create([
                    'user_id' => $user->id,
                    'type' => 'sukarela',
                    'balance' => $sukarelaBalance,
                ]);
            }
        }
    }
}
