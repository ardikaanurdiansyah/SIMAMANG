<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Divisi extends Model
{
    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'kapasitas',
        'deskripsi',
    ];

    public function pesertaMagangs(): HasMany
    {
<<<<<<< HEAD
        return $this->hasMany(PesertaMagang::class, 'divisi_id');
=======
        return $this->hasMany(PesertaMagang::class);
    }

    /**
     * Hitung peserta yang aktif
     */
    public function pesertaAktif()
    {
        return $this->pesertaMagangs()->where('status', 'Aktif')->count();
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
    }

    /**
     * Hitung jumlah peserta yang masih aktif
     */
    public function pesertaAktif(): int
    {
        return $this->pesertaMagangs()
            ->where('status', 'Aktif')
            ->count();
    }
<<<<<<< HEAD

    /**
     * Hitung jumlah kuota yang masih tersedia
     */
    public function kuotaTersisa(): int
    {
        return max(0, $this->kapasitas - $this->pesertaAktif());
    }

    /**
     * Cek apakah masih ada kuota
     */
    public function kuotaTersedia(): bool
    {
        return $this->kuotaTersisa() > 0;
    }
}
=======
}
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
