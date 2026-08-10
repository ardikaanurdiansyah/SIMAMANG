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
     * Relasi ke PesertaMagang
     */
    public function pesertaMagangs(): HasMany
    {
        return $this->hasMany(PesertaMagang::class, 'divisi_id');
    }

    /**
     * Menghitung jumlah peserta magang yang masih aktif
     */
    public function pesertaAktif(): int
    {
        return $this->pesertaMagangs()
            ->where('status', 'Aktif')
            ->count();
    }

    /**
     * Menghitung sisa kuota divisi
     */
    public function kuotaTersisa(): int
    {
        return max(
            0,
            $this->kapasitas - $this->pesertaAktif()
        );
    }

    /**
     * Mengecek apakah divisi masih memiliki kuota
     */
    public function kuotaTersedia(): bool
    {
        return $this->kuotaTersisa() > 0;
    }
}
