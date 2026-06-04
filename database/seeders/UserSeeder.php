<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@koperasi.test',
            'password' => Hash::make('password'),
            'member_code' => 'ADM-001',
            'phone' => '081234567890',
            'status' => 'active',
            'join_date' => now()->subYears(3),
        ]);
        $admin->assignRole('admin');

        $users = [
            ['name' => 'Pengurus Utama', 'email' => 'pengurus@koperasi.test', 'role' => 'pengurus', 'code' => 'PGS-001'],
            ['name' => 'Budi Santoso', 'email' => 'pengurus2@koperasi.test', 'role' => 'pengurus', 'code' => 'PGS-002'],
        ];

        foreach ($users as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'member_code' => $data['code'],
                'phone' => fake()->phoneNumber(),
                'status' => 'active',
                'join_date' => now()->subYears(2),
            ]);
            $user->assignRole($data['role']);
        }

        $pengawasUsers = [
            ['name' => 'Pengawas Utama', 'code' => 'PWS-001'],
            ['name' => 'Siti Rahmawati', 'code' => 'PWS-002'],
        ];

        foreach ($pengawasUsers as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => strtolower(str_replace(' ', '.', $data['name'])).'@koperasi.test',
                'password' => Hash::make('password'),
                'member_code' => $data['code'],
                'phone' => fake()->phoneNumber(),
                'status' => 'active',
                'join_date' => now()->subYears(2),
            ]);
            $user->assignRole('pengawas');
        }

        $anggotaUsers = [];
        for ($i = 1; $i <= 20; $i++) {
            $anggotaUsers[] = [
                'name' => fake()->name(),
                'code' => 'AGT-'.str_pad((string) $i, 4, '0', STR_PAD_LEFT),
            ];
        }

        foreach ($anggotaUsers as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => strtolower(str_replace(' ', '.', $data['name'])).'@koperasi.test',
                'password' => Hash::make('password'),
                'member_code' => $data['code'],
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'nik' => fake()->numerify('################'),
                'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),
                'join_date' => fake()->dateTimeBetween('-5 years', '-1 month'),
            ]);
            $user->assignRole('anggota');
        }
    }
}
