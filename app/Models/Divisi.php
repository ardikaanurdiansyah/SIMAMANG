<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'kapasitas',
        'deskripsi',
    ];

    public function pesertaMagangs()
    {
        return $this->hasMany(PesertaMagang::class);
    }

    public function kuotaTerpakai(): int
    {
        return $this->pesertaMagangs()->where('status' , 'Aktif')->count();
    }

    public function kuotaTersisa(): int
    {
        return max(0, $this->kapasitas - $this->kuotaTerpakai());
    }

    public function kuotaTersedia(): bool
    {
        return $this->sisaKuota() > 0;
    }
}
