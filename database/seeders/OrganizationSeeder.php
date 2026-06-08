<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::create([
            'name' => 'Koperasi Karyawan Harmoni',
            'company_name' => 'PT. Harmoni Sejahtera',
            'email' => 'koperasi@harmoni.co.id',
            'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            'pokok_amount' => 500000,
            'wajib_amount' => 100000,
            'bunga_rate' => 10,
            'metode' => 'flat',
            'payment_method' => 'bulanan',
            'payroll_enabled' => false,
            'payroll_date' => 25,
            'max_salary_deduction' => 30,
            'max_tenor' => 12,
            'max_loan_percentage' => 200,
            'max_loan_amount' => 0,
            'minimum_cash_reserve' => 0,
            'require_active_member' => true,
            'shu_savings_allocation' => 40,
            'shu_loan_allocation' => 30,
            'shu_reserve_allocation' => 20,
            'shu_social_allocation' => 10,
            'phone' => '021-12345678',
            'website' => 'https://koperasi.harmoni.co.id',
        ]);
    }
}
