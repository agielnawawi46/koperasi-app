<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shu_id')->constrained('shu')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('status', 20)->default('pending'); // pending, distributed
            $table->timestamp('distributed_at')->nullable();
            $table->timestamps();

            $table->unique(['shu_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu_members');
    }
};
