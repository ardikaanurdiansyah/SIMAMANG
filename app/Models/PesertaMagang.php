<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    protected $fillable = [
        'nama',
        'asal_sekolah',
        'jurusan',
        'no_hp',
        'email',
        'divisi_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
