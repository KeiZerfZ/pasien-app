<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Facades\Schema; // Import Schema

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Desa::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $singkawangBarat = Kecamatan::where('nama_kecamatan', 'Singkawang Barat')->first();
        $singkawangTengah = Kecamatan::where('nama_kecamatan', 'Singkawang Tengah')->first();
        $pontianakKota = Kecamatan::where('nama_kecamatan', 'Pontianak Kota')->first();

        $desas = [];
        if ($singkawangBarat) {
            $desas[] = ['kecamatan_id' => $singkawangBarat->id, 'nama_desa' => 'Pasiran'];
            $desas[] = ['kecamatan_id' => $singkawangBarat->id, 'nama_desa' => 'Kuala'];
            $desas[] = ['kecamatan_id' => $singkawangBarat->id, 'nama_desa' => 'Melayu'];
        }
        if ($singkawangTengah) {
            $desas[] = ['kecamatan_id' => $singkawangTengah->id, 'nama_desa' => 'Roban'];
            $desas[] = ['kecamatan_id' => $singkawangTengah->id, 'nama_desa' => 'Jawa'];
            $desas[] = ['kecamatan_id' => $singkawangTengah->id, 'nama_desa' => 'Sejangkung'];
        }
        if ($pontianakKota) {
            $desas[] = ['kecamatan_id' => $pontianakKota->id, 'nama_desa' => 'Darat Sekip'];
            $desas[] = ['kecamatan_id' => $pontianakKota->id, 'nama_desa' => 'Sungai Jawi Dalam'];
        }

        foreach ($desas as $desa) {
            Desa::firstOrCreate($desa);
        }

        $this->command->info('Desa seeded for selected districts!');
    }
}

