<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'kuota',
        'kuota_terpakai',
        'deskripsi',
    ];

    public function pesertaMagang()
    {
        return $this->hasMany(PesertaMagang::class);
    }

    public function kuotaTersisa(): int
    {
        return max(0, $this->kuota - $this->kuota_terpakai);
    }

    public function kuotaTersedia(): bool
    {
        return $this->kuotaTersisa() > 0;
    }
}