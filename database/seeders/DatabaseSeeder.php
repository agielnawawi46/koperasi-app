<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            OrganizationSeeder::class,
            UserSeeder::class,
            SavingSeeder::class,
            LoanSeeder::class,
            ShuSeeder::class,
            PayrollSeeder::class,
            ActivityLogSeeder::class,
        ]);
    }
}
