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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pengguna', 25)->nullable();
            $table->string('nama_belakang', 25)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('profil_path')->nullable();
            $table->string('alamat', 500)->nullable();
            $table->string('pekerjaan', 25)->nullable();
            $table->bigInteger('dilihat_berapa_kali')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
