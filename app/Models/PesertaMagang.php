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
        'keterangan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relationship ke Divisi
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }

    /**
     * Relationship ke User (Pembimbing)
     */
    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
