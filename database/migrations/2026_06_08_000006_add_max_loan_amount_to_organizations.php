<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            if (! Schema::hasColumn('organizations', 'max_loan_amount')) {
                $table->decimal('max_loan_amount', 15, 2)->default(0)->after('max_loan_percentage');
            }
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            if (Schema::hasColumn('organizations', 'max_loan_amount')) {
                $table->dropColumn('max_loan_amount');
            }
        });
    }
};
