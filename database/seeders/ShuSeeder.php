<?php

namespace Database\Seeders;

use App\Models\Shu;
use App\Models\ShuMember;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShuSeeder extends Seeder
{
    public function run(): void
    {
        $years = [2024, 2025];
        $users = User::role('anggota')->get();

        foreach ($years as $year) {
            $totalAmount = fake()->randomElement([25000000, 30000000, 35000000, 40000000]);
            $distributedAmount = $totalAmount * 0.85;

            $shu = Shu::create([
                'year' => $year,
                'total_income' => $totalAmount + fake()->numberBetween(1000000, 5000000),
                'total_expenses' => fake()->numberBetween(1000000, 5000000),
                'total_amount' => $totalAmount,
                'distributed_amount' => $distributedAmount,
                'remaining_amount' => $totalAmount - $distributedAmount,
                'status' => $year === 2025 ? 'open' : 'closed',
                'calculated_at' => $year === 2024 ? now()->subMonths(3) : null,
            ]);

            $perMember = round($distributedAmount / max(1, $users->count()), 2);
            foreach ($users as $user) {
                ShuMember::create([
                    'shu_id' => $shu->id,
                    'user_id' => $user->id,
                    'amount' => fake()->randomFloat(2, 50000, 2000000),
                    'status' => $year === 2024 ? 'distributed' : 'pending',
                    'distributed_at' => $year === 2024 ? now()->subMonths(2) : null,
                ]);
            }
        }
    }
}
