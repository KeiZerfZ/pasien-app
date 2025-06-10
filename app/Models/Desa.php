<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desas';
    protected $fillable = ['kecamatan_id', 'nama_desa'];

    /**
     * Definisi relasi: Satu Desa dimiliki oleh satu Kecamatan.
     */
    public function kecamatan()
    {
        // Mengindikasikan bahwa model Desa dimiliki oleh (belongsTo) satu model Kecamatan.
        // Ini berarti tabel 'desas' memiliki foreign key 'kecamatan_id' yang merujuk ke 'id' dari tabel 'kecamatans'.
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Definisi relasi: Satu Desa bisa dimiliki oleh banyak Pasien.
     * Ini akan menjadi foreign key untuk alamat pasien.
     */
    public function pasien()
    {
        // Mengindikasikan bahwa model Desa memiliki banyak (hasMany) model Pasien.
        // Ini berarti setiap pasien akan memiliki foreign key 'desa_id' yang merujuk ke 'id' desa ini.
        return $this->hasMany(Pasien::class);
    }
}

