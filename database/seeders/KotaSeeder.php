<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Support\Facades\Schema; // Import Schema

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kota::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $kalbar = Provinsi::where('nama_provinsi', 'Kalimantan Barat')->first();

        $kotas = [];
        if ($kalbar) {
            $kotas[] = ['provinsi_id' => $kalbar->id, 'nama_kota' => 'Kota Pontianak'];
            $kotas[] = ['provinsi_id' => $kalbar->id, 'nama_kota' => 'Kota Singkawang'];
        }

        foreach ($kotas as $kota) {
            Kota::firstOrCreate($kota);
        }

        $this->command->info('Kota seeded for Kalimantan Barat!');
    }
}

