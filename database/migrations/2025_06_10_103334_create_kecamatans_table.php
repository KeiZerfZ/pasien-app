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
        // Membuat tabel 'kecamatans' untuk menyimpan daftar kecamatan.
        // Memiliki foreign key ke tabel 'kotas'.
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->foreignId('kota_id')->constrained('kotas')->onDelete('cascade'); // Foreign key ke tabel 'kotas'
            $table->string('nama_kecamatan'); // Nama kecamatan
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan unique constraint untuk memastikan nama kecamatan unik dalam satu kota
            $table->unique(['kota_id', 'nama_kecamatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'kecamatans' jika migrasi di-rollback.
        Schema::dropIfExists('kecamatans');
    }
};

