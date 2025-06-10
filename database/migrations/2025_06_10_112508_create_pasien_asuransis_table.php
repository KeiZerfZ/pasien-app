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
        // Membuat tabel 'pasien_asuransis' untuk menyimpan data asuransi pasien.
        // Memiliki foreign key ke tabel 'pasien' dan 'jenis_asuransis'.
        Schema::create('pasien_asuransis', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade'); // Foreign key ke tabel 'pasien', hapus data asuransi jika pasien dihapus
            $table->foreignId('jenis_asuransi_id')->constrained('jenis_asuransis')->onDelete('cascade'); // Foreign key ke tabel 'jenis_asuransis'
            $table->string('nomor_asuransi')->unique(); // Nomor asuransi, harus unik
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan unique constraint untuk memastikan satu pasien tidak memiliki nomor asuransi yang sama dengan jenis asuransi yang sama
            $table->unique(['pasien_id', 'jenis_asuransi_id', 'nomor_asuransi'], 'pasien_asuransi_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'pasien_asuransis' jika migrasi di-rollback.
        Schema::dropIfExists('pasien_asuransis');
    }
};

