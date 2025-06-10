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
        // Membuat tabel 'jenis_asuransis' untuk menyimpan daftar jenis asuransi.
        Schema::create('jenis_asuransis', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->string('nama_jenis')->unique(); // Nama jenis asuransi, harus unik
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'jenis_asuransis' jika migrasi di-rollback.
        Schema::dropIfExists('jenis_asuransis');
    }
};

