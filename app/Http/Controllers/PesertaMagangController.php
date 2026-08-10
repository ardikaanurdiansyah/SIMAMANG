<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaMagangController extends Controller
{
    public function dashboard()
    {
        $divisis = Divisi::all();

        return view('peserta.dashboard', compact('divisis'));
    }

    public function create()
    {
        $divisis = Divisi::all()
            ->filter(fn ($d) => $d->kuotaTersedia());

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
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $divisi = Divisi::whereKey($validated['divisi_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $kuotaTerpakai = $divisi->pesertaMagangs()
                    ->where('status', 'Aktif')
                    ->count();

                if ($kuotaTerpakai >= $divisi->kapasitas) {
                    throw new \RuntimeException(
                        'Kuota divisi ' . $divisi->nama_divisi . ' sudah penuh.'
                    );
                }

                PesertaMagang::create([
                    ...$validated,
                    'status' => 'Aktif',
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()
                ->withErrors([
                    'divisi_id' => $e->getMessage(),
                ])
                ->withInput();
        }

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Peserta berhasil diterima magang, kuota divisi otomatis terupdate.'
            );
    }

    public function riwayat()
    {
        $riwayat = PesertaMagang::with('divisi')
            ->where('status', 'Selesai')
            ->latest()
            ->get();

        return view('peserta.riwayat', compact('riwayat'));
    }

    public function selesaikan(PesertaMagang $peserta)
    {
        $peserta->update(['status' => 'Selesai']);

        return back()->with(
            'success',
            'Peserta ' . $peserta->nama . ' berhasil diselesaikan, kuota divisi otomatis terupdate.'
        );
    }

    public function exportPdf($id)
    {
        $peserta = PesertaMagang::with('divisi')->findOrFail($id);

        $pdf = Pdf::loadView(
            'peserta.pdf-single',
            compact('peserta')
        );

        return $pdf->download(
            'peserta-magang-' . str()->slug($peserta->nama) . '.pdf'
        );
    }
}