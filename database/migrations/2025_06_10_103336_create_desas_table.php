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
        // Membuat tabel 'desas' untuk menyimpan daftar desa/kelurahan.
        // Memiliki foreign key ke tabel 'kecamatans'.
        Schema::create('desas', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade'); // Foreign key ke tabel 'kecamatans'
            $table->string('nama_desa'); // Nama desa/kelurahan
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan unique constraint untuk memastikan nama desa unik dalam satu kecamatan
            $table->unique(['kecamatan_id', 'nama_desa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'desas' jika migrasi di-rollback.
        Schema::dropIfExists('desas');
    }
};

