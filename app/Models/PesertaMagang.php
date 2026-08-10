<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    protected $fillable = [
        'divisi_id',
        'nama',
        'asal_instansi',
        'jurusan',
        'no_hp',
        'email',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}