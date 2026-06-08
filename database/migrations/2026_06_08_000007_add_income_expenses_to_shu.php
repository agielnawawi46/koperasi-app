<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shu', function (Blueprint $table) {
            if (! Schema::hasColumn('shu', 'total_income')) {
                $table->decimal('total_income', 15, 2)->default(0)->after('year');
            }
            if (! Schema::hasColumn('shu', 'total_expenses')) {
                $table->decimal('total_expenses', 15, 2)->default(0)->after('total_income');
            }
            if (! Schema::hasColumn('shu', 'calculated_at')) {
                $table->timestamp('calculated_at')->nullable()->after('notes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shu', function (Blueprint $table) {
            $columns = ['total_income', 'total_expenses', 'calculated_at'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('shu', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
