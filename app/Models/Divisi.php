<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
<<<<<<< HEAD
        'kapasitas',
        'deskripsi'
    ];

    /**
     * Relationship ke PesertaMagang
     */
    public function pesertaMagangs(): HasMany
=======
        'kuota',
        'kuota_terpakai',
        'deskripsi',
    ];

    public function pesertaMagang()
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d
    {
        return $this->hasMany(PesertaMagang::class);
    }

<<<<<<< HEAD
    /**
     * Hitung peserta yang aktif
     */
    public function pesertaAktif()
    {
        return $this->pesertaMagangs()->where('status', 'Aktif')->count();
    }

    /**
     * Hitung kuota tersisa
     */
    public function kuotaTersisa()
    {
        return $this->kapasitas - $this->pesertaAktif();
    }
}
=======
    public function kuotaTersisa(): int
    {
        return max(0, $this->kuota - $this->kuota_terpakai);
    }

    public function kuotaTersedia(): bool
    {
        return $this->kuotaTersisa() > 0;
    }
}
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d
