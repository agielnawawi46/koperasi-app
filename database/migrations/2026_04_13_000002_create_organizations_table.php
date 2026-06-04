<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name');
            $table->string('email');
            $table->text('address')->nullable();
            $table->decimal('pokok_amount', 15, 2)->default(0);
            $table->decimal('wajib_amount', 15, 2)->default(0);
            $table->decimal('bunga_rate', 5, 2)->default(0);
            $table->string('metode')->default('flat');
            $table->string('payment_method')->default('bulanan');
            $table->integer('tgl_tagihan')->default(1);
            $table->string('phone', 20)->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
