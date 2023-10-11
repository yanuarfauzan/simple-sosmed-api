<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengguna_id');
            $table->string('filepath_postingan')->nullable();
            $table->string('deskripsi_postingan');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postingan');
    }
};