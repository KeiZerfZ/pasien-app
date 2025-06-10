<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien'; // Nama tabel pasien
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan_id',
        'desa_id',
        'jenis_kelamin',
        'foto_pasien',
    ];

    // Ganti 'protected $dates' dengan 'protected $casts'
    // Ini adalah cara yang lebih modern dan disarankan di Laravel
    protected $casts = [
        'tanggal_lahir' => 'date', // Laravel akan otomatis mengubahnya menjadi objek Carbon
    ];


    /**
     * Definisi relasi: Satu Pasien dimiliki oleh satu Pekerjaan.
     */
    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    /**
     * Definisi relasi: Satu Pasien dimiliki oleh satu Desa.
     */
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    /**
     * Definisi relasi: Satu Pasien bisa memiliki banyak RiwayatPenyakit.
     */
    public function riwayatPenyakits()
    {
        return $this->hasMany(RiwayatPenyakit::class);
    }

    /**
     * Definisi relasi: Satu Pasien bisa memiliki banyak PasienAsuransi.
     */
    public function pasienAsuransis()
    {
        return $this->hasMany(PasienAsuransi::class);
    }
}

