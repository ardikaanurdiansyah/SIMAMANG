<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaMagang extends Model
{
    protected $fillable = [
        'nama',
        'asal_instansi',
        'jurusan',
        'no_hp',
        'email',
        'divisi_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'nilai',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(USer::class, 'user_id');
    }
}