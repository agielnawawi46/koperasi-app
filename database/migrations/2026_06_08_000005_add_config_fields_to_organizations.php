<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            if (! Schema::hasColumn('organizations', 'payroll_enabled')) {
                $table->boolean('payroll_enabled')->default(false)->after('payment_method');
            }
            if (! Schema::hasColumn('organizations', 'payroll_date')) {
                $table->integer('payroll_date')->default(25)->after('payroll_enabled');
            }
            if (! Schema::hasColumn('organizations', 'max_salary_deduction')) {
                $table->decimal('max_salary_deduction', 5, 2)->default(30)->after('payroll_date');
            }
            if (! Schema::hasColumn('organizations', 'max_tenor')) {
                $table->integer('max_tenor')->default(12)->after('metode');
            }
            if (! Schema::hasColumn('organizations', 'max_loan_percentage')) {
                $table->decimal('max_loan_percentage', 5, 2)->default(200)->after('max_tenor');
            }
            if (! Schema::hasColumn('organizations', 'minimum_cash_reserve')) {
                $table->decimal('minimum_cash_reserve', 15, 2)->default(0)->after('max_loan_percentage');
            }
            if (! Schema::hasColumn('organizations', 'require_active_member')) {
                $table->boolean('require_active_member')->default(true)->after('minimum_cash_reserve');
            }
            if (! Schema::hasColumn('organizations', 'shu_savings_allocation')) {
                $table->decimal('shu_savings_allocation', 5, 2)->default(40)->after('require_active_member');
            }
            if (! Schema::hasColumn('organizations', 'shu_loan_allocation')) {
                $table->decimal('shu_loan_allocation', 5, 2)->default(30)->after('shu_savings_allocation');
            }
            if (! Schema::hasColumn('organizations', 'shu_reserve_allocation')) {
                $table->decimal('shu_reserve_allocation', 5, 2)->default(20)->after('shu_loan_allocation');
            }
            if (! Schema::hasColumn('organizations', 'shu_social_allocation')) {
                $table->decimal('shu_social_allocation', 5, 2)->default(10)->after('shu_reserve_allocation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $columns = [
                'payroll_enabled', 'payroll_date', 'max_salary_deduction',
                'max_tenor', 'max_loan_percentage', 'minimum_cash_reserve', 'require_active_member',
                'shu_savings_allocation', 'shu_loan_allocation', 'shu_reserve_allocation', 'shu_social_allocation',
            ];
            foreach ($columns as $col) {
                if (Schema::hasColumn('organizations', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
