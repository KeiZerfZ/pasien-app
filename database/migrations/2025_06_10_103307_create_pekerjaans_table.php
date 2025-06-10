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
        // Membuat tabel 'pekerjaans' untuk menyimpan daftar pekerjaan.
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->string('nama_pekerjaan')->unique(); // Nama pekerjaan, harus unik
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'pekerjaans' jika migrasi di-rollback.
        Schema::dropIfExists('pekerjaans');
    }
};

