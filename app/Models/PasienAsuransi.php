<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienAsuransi extends Model
{
    use HasFactory;

    protected $table = 'pasien_asuransis';
    protected $fillable = [
        'pasien_id',
        'jenis_asuransi_id',
        'nomor_asuransi',
    ];

    /**
     * Definisi relasi: Satu PasienAsuransi dimiliki oleh satu Pasien.
     */
    public function pasien()
    {
        // Mengindikasikan bahwa model PasienAsuransi dimiliki oleh (belongsTo) satu model Pasien.
        // Ini berarti tabel 'pasien_asuransis' memiliki foreign key 'pasien_id' yang merujuk ke 'id' dari tabel 'pasien'.
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Definisi relasi: Satu PasienAsuransi dimiliki oleh satu JenisAsuransi.
     */
    public function jenisAsuransi()
    {
        // Mengindikasikan bahwa model PasienAsuransi dimiliki oleh (belongsTo) satu model JenisAsuransi.
        // Ini berarti tabel 'pasien_asuransis' memiliki foreign key 'jenis_asuransi_id' yang merujuk ke 'id' dari tabel 'jenis_asuransis'.
        return $this->belongsTo(JenisAsuransi::class);
    }
}

