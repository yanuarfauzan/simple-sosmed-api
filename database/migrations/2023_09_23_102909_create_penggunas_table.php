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
            $table->string('username')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('nama_depan', 25)->nullable();
            $table->string('nama_belakang', 25)->nullable();
            $table->string('profil_path')->nullable();
            $table->string('alamat', 500)->nullable();
            $table->string('pekerjaan', 25)->nullable();
            $table->bigInteger('dilihat_berapa_kali')->nullable();
            $table->string('token_verify', 64)->nullable();
            $table->boolean('is_verify')->nullable();
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
