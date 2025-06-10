<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisAsuransi;
use Illuminate\Support\Facades\Schema; // Import Schema

class JenisAsuransiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        JenisAsuransi::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $jenisAsuransis = [
            ['nama_jenis' => 'BPJS Kesehatan'],
            ['nama_jenis' => 'BPJS Ketenagakerjaan'],
            ['nama_jenis' => 'Asuransi Swasta A'],
            ['nama_jenis' => 'Asuransi Swasta B'],
            ['nama_jenis' => 'Lain-lain'],
        ];

        foreach ($jenisAsuransis as $jenis) {
            JenisAsuransi::create($jenis);
        }

        $this->command->info('JenisAsuransi seeded!');
    }
}

