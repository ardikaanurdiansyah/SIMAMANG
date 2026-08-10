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

    /**
     * Relationship ke PesertaMagang
     */
    public function pesertaMagangs(): HasMany
    {
        return $this->hasMany(PesertaMagang::class, 'divisi_id');
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