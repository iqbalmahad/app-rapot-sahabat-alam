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
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('nis')->unique();
            $table->string('tahun_masuk_tk')->nullable();
            $table->string('tahun_masuk_sd')->nullable();
            $table->string('tahun_masuk_smp')->nullable();
            $table->uuid('user_uuid');
            $table->foreign('user_uuid')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
