<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAsuransi extends Model
{
    use HasFactory;

    protected $table = 'jenis_asuransis';
    protected $fillable = ['nama_jenis'];

    /**
     * Definisi relasi: Satu JenisAsuransi bisa dimiliki oleh banyak PasienAsuransi.
     */
    public function pasienAsuransis()
    {
        // Mengindikasikan bahwa model JenisAsuransi memiliki banyak (hasMany) model PasienAsuransi.
        // Ini berarti setiap data asuransi pasien akan memiliki foreign key 'jenis_asuransi_id' yang merujuk ke 'id' jenis asuransi ini.
        return $this->hasMany(PasienAsuransi::class);
    }
}

