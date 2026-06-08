<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (! Schema::hasColumn('loans', 'disbursed_by')) {
                $table->foreignId('disbursed_by')->nullable()->constrained('users')->nullOnDelete()->after('approved_at');
            }
            if (! Schema::hasColumn('loans', 'disbursed_at')) {
                $table->timestamp('disbursed_at')->nullable()->after('disbursed_by');
            }
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'disbursed_at')) {
                $table->dropColumn('disbursed_at');
            }
            if (Schema::hasColumn('loans', 'disbursed_by')) {
                $table->dropForeign(['disbursed_by']);
                $table->dropColumn('disbursed_by');
            }
        });
    }
};
