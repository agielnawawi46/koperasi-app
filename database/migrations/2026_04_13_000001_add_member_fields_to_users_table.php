<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_code', 20)->unique()->nullable()->after('id');
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('nik', 30)->nullable()->after('phone');
            $table->string('address')->nullable()->after('nik');
            $table->string('status', 20)->default('active')->after('remember_token');
            $table->date('join_date')->nullable()->after('status');
            $table->string('avatar')->nullable()->after('join_date');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['member_code', 'phone', 'nik', 'address', 'status', 'join_date', 'avatar']);
        });
    }
};
