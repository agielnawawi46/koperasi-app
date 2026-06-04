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
            'tgl_tagihan' => 5,
            'phone' => '021-12345678',
            'website' => 'https://koperasi.harmoni.co.id',
        ]);
    }
}
