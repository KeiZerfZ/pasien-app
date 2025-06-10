<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = 'kotas';
    protected $fillable = ['provinsi_id', 'nama_kota'];

    /**
     * Definisi relasi: Satu Kota dimiliki oleh satu Provinsi.
     */
    public function provinsi()
    {
        // Mengindikasikan bahwa model Kota dimiliki oleh (belongsTo) satu model Provinsi.
        // Ini berarti tabel 'kotas' memiliki foreign key 'provinsi_id' yang merujuk ke 'id' dari tabel 'provinsis'.
        return $this->belongsTo(Provinsi::class);
    }

    /**
     * Definisi relasi: Satu Kota bisa memiliki banyak Kecamatan.
     */
    public function kecamatans()
    {
        // Mengindikasikan bahwa model Kota memiliki banyak (hasMany) model Kecamatan.
        // Ini berarti setiap kecamatan akan memiliki foreign key 'kota_id' yang merujuk ke 'id' kota ini.
        return $this->hasMany(Kecamatan::class);
    }
}

