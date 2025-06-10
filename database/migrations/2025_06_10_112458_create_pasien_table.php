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
        // Membuat tabel 'pasien' untuk menyimpan data utama pasien.
        // Memiliki foreign key ke tabel 'pekerjaans' dan 'desas'.
        Schema::create('pasien', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->string('nama'); // Nama pasien, wajib diisi
            $table->string('nik')->unique(); // Nomor Induk Kependudukan (NIK), wajib dan unik
            $table->string('tempat_lahir')->nullable(); // Tempat lahir, opsional
            $table->date('tanggal_lahir'); // Tanggal lahir, format tanggal
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans'); // Foreign key ke tabel 'pekerjaans'
            $table->foreignId('desa_id')->constrained('desas'); // Foreign key ke tabel 'desas' (untuk alamat lengkap)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin, menggunakan radio button
            $table->string('foto_pasien')->nullable(); // Path/nama file foto pasien, opsional
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'pasien' jika migrasi di-rollback.
        Schema::dropIfExists('pasien');
    }
};

