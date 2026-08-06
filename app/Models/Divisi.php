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
        'deskripsi'
    ];

    /**
     * Relationship ke PesertaMagang
     */
    public function pesertaMagangs(): HasMany
    {
        return $this->hasMany(PesertaMagang::class);
    }

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
