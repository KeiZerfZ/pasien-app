<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Schema; // Import Schema

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key checks sementara untuk menghindari error saat truncate
        Schema::disableForeignKeyConstraints();
        Pekerjaan::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints(); // Aktifkan kembali foreign key checks

        $pekerjaans = [
            ['nama_pekerjaan' => 'PNS'],
            ['nama_pekerjaan' => 'Swasta'],
            ['nama_pekerjaan' => 'Wiraswasta'],
            ['nama_pekerjaan' => 'Pelajar/Mahasiswa'],
            ['nama_pekerjaan' => 'Ibu Rumah Tangga'],
            ['nama_pekerjaan' => 'Tidak Bekerja'],
            ['nama_pekerjaan' => 'Lain-lain'],
        ];

        foreach ($pekerjaans as $pekerjaan) {
            Pekerjaan::create($pekerjaan);
        }

        $this->command->info('Pekerjaan seeded!');
    }
}

