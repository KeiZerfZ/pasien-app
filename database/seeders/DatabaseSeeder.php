<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PekerjaanSeeder::class,
            JenisAsuransiSeeder::class,
            ProvinsiSeeder::class,     // Penting: Provinsi harus ada dulu
            KotaSeeder::class,         // Lalu Kota
            KecamatanSeeder::class,    // Lalu Kecamatan
            DesaSeeder::class,         // Lalu Desa
        ]);

        $this->command->info('All initial seeders completed for Kalimantan Barat focus!');
    }
}

