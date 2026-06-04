<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $actions = [
            'login', 'logout', 'create_loan', 'approve_loan', 'reject_loan',
            'create_saving', 'create_transaction', 'view_report', 'update_profile',
            'manage_user', 'process_payroll', 'distribute_shu',
        ];

        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => $actions[array_rand($actions)],
                'description' => fake()->sentence(),
                'ip_address' => fake()->ipv4(),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => fake()->dateTimeBetween('-30 days'),
            ]);
        }
    }
}
