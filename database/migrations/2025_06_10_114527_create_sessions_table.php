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
        // Membuat tabel 'sessions' untuk menyimpan data sesi Laravel.
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi, sebagai primary key
            $table->foreignId('user_id')->nullable()->index(); // Opsional: foreign key ke user_id jika user login
            $table->string('ip_address', 45)->nullable(); // Alamat IP klien
            $table->text('user_agent')->nullable(); // User agent browser
            $table->longText('payload'); // Data sesi yang terenkripsi
            $table->integer('last_activity')->index(); // Waktu terakhir aktivitas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'sessions' jika migrasi di-rollback.
        Schema::dropIfExists('sessions');
    }
};

