<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shu_members', function (Blueprint $table) {
            if (! Schema::hasColumn('shu_members', 'modal_amount')) {
                $table->decimal('modal_amount', 15, 2)->default(0)->after('amount');
            }
            if (! Schema::hasColumn('shu_members', 'member_amount')) {
                $table->decimal('member_amount', 15, 2)->default(0)->after('modal_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('shu_members', function (Blueprint $table) {
            $columns = ['modal_amount', 'member_amount'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('shu_members', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
