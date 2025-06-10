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
        // Membuat tabel 'riwayat_penyakits' untuk menyimpan riwayat penyakit pasien.
        // Memiliki foreign key ke tabel 'pasien'.
        Schema::create('riwayat_penyakits', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade'); // Foreign key ke tabel 'pasien', hapus riwayat jika pasien dihapus
            $table->string('nama_penyakit'); // Nama penyakit
            $table->year('tahun'); // Tahun penyakit
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'riwayat_penyakits' jika migrasi di-rollback.
        Schema::dropIfExists('riwayat_penyakits');
    }
};

