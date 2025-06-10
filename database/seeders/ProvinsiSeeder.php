<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Schema; // Import Schema

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Provinsi::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $provinsis = [
            ['nama_provinsi' => 'Kalimantan Barat'],
        ];

        foreach ($provinsis as $provinsi) {
            Provinsi::create($provinsi);
        }

        $this->command->info('Provinsi seeded with Kalimantan Barat!');
    }
}

