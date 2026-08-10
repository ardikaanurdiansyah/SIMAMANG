<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209

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
<<<<<<< HEAD
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
=======
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
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
}