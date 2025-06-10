<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kota;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Schema; // Import Schema

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kecamatan::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $pontianak = Kota::where('nama_kota', 'Kota Pontianak')->first();
        $singkawang = Kota::where('nama_kota', 'Kota Singkawang')->first();

        $kecamatans = [];
        if ($pontianak) {
            $kecamatans[] = ['kota_id' => $pontianak->id, 'nama_kecamatan' => 'Pontianak Kota'];
            $kecamatans[] = ['kota_id' => $pontianak->id, 'nama_kecamatan' => 'Pontianak Utara'];
        }
        if ($singkawang) {
            $kecamatans[] = ['kota_id' => $singkawang->id, 'nama_kecamatan' => 'Singkawang Barat'];
            $kecamatans[] = ['kota_id' => $singkawang->id, 'nama_kecamatan' => 'Singkawang Timur'];
            $kecamatans[] = ['kota_id' => $singkawang->id, 'nama_kecamatan' => 'Singkawang Selatan'];
            $kecamatans[] = ['kota_id' => $singkawang->id, 'nama_kecamatan' => 'Singkawang Utara'];
            $kecamatans[] = ['kota_id' => $singkawang->id, 'nama_kecamatan' => 'Singkawang Tengah'];
        }

        foreach ($kecamatans as $kecamatan) {
            Kecamatan::firstOrCreate($kecamatan);
        }

        $this->command->info('Kecamatan seeded for selected cities!');
    }
}

