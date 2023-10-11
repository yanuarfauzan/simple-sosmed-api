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
        Schema::create('teman', function (Blueprint $table) {
            $table->id();
            $table->uuid('pengguna_id')->nullable();
            $table->uuid('teman_id')->nullable();
            $table->timestamps();
            $table->foreign('pengguna_id')->references('id')->on('pengguna');
            $table->foreign('teman_id')->references('id')->on('pengguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teman');
    }
};
