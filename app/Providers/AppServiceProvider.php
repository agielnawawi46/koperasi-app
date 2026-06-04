<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! Schema::hasTable('roles')) {
            return;
        }

        $requiredRoles = ['super_admin', 'admin', 'anggota', 'pengurus', 'pengawas'];
        $existingCount = Role::where('guard_name', 'web')->whereIn('name', $requiredRoles)->count();

        if ($existingCount === count($requiredRoles)) {
            return;
        }

        try {
            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

            $permissions = [
                'manage-organization', 'manage-users', 'manage-payrolls', 'view-monitoring', 'manage-settings',
                'view-savings', 'view-loans', 'view-installments', 'view-shu', 'manage-profile',
                'manage-savings-transactions', 'manage-loans', 'input-installments', 'view-daily-reports', 'view-monitoring-data',
                'audit-loans', 'audit-savings', 'view-members-data', 'view-installment-recaps', 'view-shu-reports',
            ];

            foreach ($permissions as $permission) {
                Permission::findOrCreate($permission, 'web');
            }

            $superAdmin = Role::findOrCreate('super_admin', 'web');
            $superAdmin->givePermissionTo(Permission::all());

            $admin = Role::findOrCreate('admin', 'web');
            $admin->givePermissionTo(Permission::all());

            $anggota = Role::findOrCreate('anggota', 'web');
            $anggota->givePermissionTo([
                'view-savings', 'view-loans', 'view-installments', 'view-shu', 'manage-profile',
            ]);

            $pengurus = Role::findOrCreate('pengurus', 'web');
            $pengurus->givePermissionTo([
                'manage-savings-transactions', 'manage-loans', 'input-installments', 'view-daily-reports', 'view-monitoring-data',
            ]);

            $pengawas = Role::findOrCreate('pengawas', 'web');
            $pengawas->givePermissionTo([
                'audit-loans', 'audit-savings', 'view-members-data', 'view-installment-recaps', 'view-shu-reports',
            ]);

            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();
        } catch (\Exception $e) {
            logger()->error('Role seeding failed: '.$e->getMessage());
        }
    }
}
