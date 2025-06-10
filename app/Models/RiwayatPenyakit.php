<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenyakit extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penyakits';
    protected $fillable = [
        'pasien_id',
        'nama_penyakit',
        'tahun',
    ];

    /**
     * Definisi relasi: Satu RiwayatPenyakit dimiliki oleh satu Pasien.
     */
    public function pasien()
    {
        // Mengindikasikan bahwa model RiwayatPenyakit dimiliki oleh (belongsTo) satu model Pasien.
        // Ini berarti tabel 'riwayat_penyakits' memiliki foreign key 'pasien_id' yang merujuk ke 'id' dari tabel 'pasien'.
        return $this->belongsTo(Pasien::class);
    }
}

