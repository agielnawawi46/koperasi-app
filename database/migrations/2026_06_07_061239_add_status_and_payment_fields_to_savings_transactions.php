<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('savings_transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('savings_transactions', 'payment_method')) {
                $table->string('payment_method', 30)->nullable()->after('reference');
            }
            if (! Schema::hasColumn('savings_transactions', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete()->after('payment_method');
            }
            if (! Schema::hasColumn('savings_transactions', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            }
            if (! Schema::hasColumn('savings_transactions', 'reference')) {
                $table->string('reference', 50)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('savings_transactions', function (Blueprint $table) {
            $columns = ['payment_method', 'verified_by', 'verified_at'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('savings_transactions', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
