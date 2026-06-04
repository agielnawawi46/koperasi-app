<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    public function run(): void
    {
        $employees = User::role(['pengurus', 'pengawas', 'admin'])->get();
        $organization = Organization::first();

        for ($month = 1; $month <= 5; $month++) {
            foreach ($employees as $employee) {
                $baseSalary = fake()->randomElement([3500000, 4000000, 5000000, 6000000, 7500000]);
                $allowance = fake()->randomElement([500000, 750000, 1000000]);
                $wajibDeduction = $organization ? $organization->wajib_amount : 100000;
                $otherDeduction = fake()->randomElement([0, 0, 50000, 100000, 200000]);
                $netSalary = $baseSalary + $allowance - $wajibDeduction - $otherDeduction;

                Payroll::create([
                    'user_id' => $employee->id,
                    'period_month' => $month,
                    'period_year' => 2026,
                    'base_salary' => $baseSalary,
                    'allowance' => $allowance,
                    'wajib_deduction' => $wajibDeduction,
                    'other_deduction' => $otherDeduction,
                    'net_salary' => $netSalary,
                    'status' => $month < 5 ? 'paid' : 'pending',
                    'processed_at' => $month < 5 ? now()->subMonths(5 - $month)->startOfMonth() : null,
                ]);
            }
        }
    }
}
