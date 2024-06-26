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
        Schema::create('rapots', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('nis');
            $table->string('tingkatan_kelas');
            $table->integer('semester');
            $table->string('rapot');
            $table->uuid('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapots');
    }
};
