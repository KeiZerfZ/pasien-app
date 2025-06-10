<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';
    protected $fillable = ['nama_provinsi'];

    /**
     * Definisi relasi: Satu Provinsi bisa memiliki banyak Kota.
     */
    public function kotas()
    {
        // Mengindikasikan bahwa model Provinsi memiliki banyak (hasMany) model Kota.
        // Ini berarti setiap kota akan memiliki foreign key 'provinsi_id' yang merujuk ke 'id' provinsi ini.
        return $this->hasMany(Kota::class);
    }
}

