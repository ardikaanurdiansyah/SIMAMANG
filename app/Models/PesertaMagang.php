<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
=======
use App\Models\Divisi;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d

class PesertaMagangController extends Controller
{
<<<<<<< HEAD
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
=======
    public function dashboard()
    {
        $divisis = Divisi::all();

        return view('peserta.dashboard', compact('divisis'));
    }

    public function create()
    {
        $divisis = Divisi::all()->filter(fn ($d) => $d->kuotaTersedia());

        return view('peserta.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'divisi_id' => ['required', 'exists:divisis,id'],
            'nama' => ['required', 'string', 'max:255'],
            'asal_instansi' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $divisi = Divisi::where('id', $validated['divisi_id'])->lockForUpdate()->firstOrFail();

                $kuotaTerpakai = $divisi->pesertaMagangs()
                    ->where('status', 'Aktif')
                    ->lockForUpdate()
                    ->count();

                if ($kuotaTerpakai >= $divisi->kapasitas) {
                    throw new \RuntimeException('Kuota divisi ' . $divisi->nama_divisi . ' sudah penuh.');
                }

                PesertaMagang::create($validated + ['status' => 'Aktif']);
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors(['divisi_id' => $e->getMessage()])->withInput();
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Peserta berhasil diterima magang, kuota divisi otomatis terupdate.');
    }
}
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d
