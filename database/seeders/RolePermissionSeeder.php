<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Admin
            'manage-organization', 'manage-users', 'manage-payrolls', 'view-monitoring', 'manage-settings',
            // Anggota
            'view-savings', 'view-loans', 'view-installments', 'view-shu', 'manage-profile',
            // Pengurus
            'manage-savings-transactions', 'manage-loans', 'input-installments', 'view-daily-reports', 'view-monitoring-data',
            // Pengawas
            'audit-loans', 'audit-savings', 'view-members-data', 'view-installment-recaps', 'view-shu-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $anggota = Role::create(['name' => 'anggota']);
        $anggota->givePermissionTo([
            'view-savings', 'view-loans', 'view-installments', 'view-shu', 'manage-profile',
        ]);

        $pengurus = Role::create(['name' => 'pengurus']);
        $pengurus->givePermissionTo([
            'manage-savings-transactions', 'manage-loans', 'input-installments', 'view-daily-reports', 'view-monitoring-data',
        ]);

        $pengawas = Role::create(['name' => 'pengawas']);
        $pengawas->givePermissionTo([
            'audit-loans', 'audit-savings', 'view-members-data', 'view-installment-recaps', 'view-shu-reports',
        ]);
    }
}
