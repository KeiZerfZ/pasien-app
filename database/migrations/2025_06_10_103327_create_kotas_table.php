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
        // Membuat tabel 'kotas' untuk menyimpan daftar kota/kabupaten.
        // Memiliki foreign key ke tabel 'provinsis'.
        Schema::create('kotas', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment sebagai primary key
            $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade'); // Foreign key ke tabel 'provinsis'
            $table->string('nama_kota'); // Nama kota/kabupaten
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan unique constraint untuk memastikan nama kota unik dalam satu provinsi
            $table->unique(['provinsi_id', 'nama_kota']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'kotas' jika migrasi di-rollback.
        Schema::dropIfExists('kotas');
    }
};

