<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini. Defaultnya akan mencari 'pekerjaans'
    // tapi lebih baik didefinisikan secara eksplisit untuk kejelasan.
    protected $table = 'pekerjaans';

    // Kolom yang bisa diisi secara massal (mass assignable).
    // Penting untuk keamanan, mencegah pengisian kolom yang tidak diinginkan.
    protected $fillable = ['nama_pekerjaan'];

    /**
     * Definisi relasi: Satu Pekerjaan bisa dimiliki oleh banyak Pasien.
     */
    public function pasien()
    {
        // Mengindikasikan bahwa model Pekerjaan memiliki banyak (hasMany) model Pasien.
        // Ini berarti setiap pasien akan memiliki foreign key 'pekerjaan_id' yang merujuk ke 'id' pekerjaan ini.
        return $this->hasMany(Pasien::class);
    }
}

