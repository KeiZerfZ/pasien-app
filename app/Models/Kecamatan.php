<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';
    protected $fillable = ['kota_id', 'nama_kecamatan'];

    /**
     * Definisi relasi: Satu Kecamatan dimiliki oleh satu Kota.
     */
    public function kota()
    {
        // Mengindikasikan bahwa model Kecamatan dimiliki oleh (belongsTo) satu model Kota.
        // Ini berarti tabel 'kecamatans' memiliki foreign key 'kota_id' yang merujuk ke 'id' dari tabel 'kotas'.
        return $this->belongsTo(Kota::class);
    }

    /**
     * Definisi relasi: Satu Kecamatan bisa memiliki banyak Desa.
     */
    public function desas()
    {
        // Mengindikasikan bahwa model Kecamatan memiliki banyak (hasMany) model Desa.
        // Ini berarti setiap desa akan memiliki foreign key 'kecamatan_id' yang merujuk ke 'id' kecamatan ini.
        return $this->hasMany(Desa::class);
    }
}

