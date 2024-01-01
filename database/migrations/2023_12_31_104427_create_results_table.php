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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('responden_id')->nullable();
            $table->text('menggunakan_email')->nullable();
            $table->text('mengalami')->nullable();
            $table->text('kesadaran')->nullable();
            $table->text('korban')->nullable();
            $table->text('pengguna_extension')->nullable();
            $table->text('pengguna_extension_spesifik')->nullable();
            $table->text('deteksi_email')->nullable();
            $table->text('mempertimbangkan')->nullable();
            $table->text('fitur_utama')->nullable();
            $table->text('seberapa_nyaman')->nullable();
            $table->text('platform_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
