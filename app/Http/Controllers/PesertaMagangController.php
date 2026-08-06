<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\PesertaMagang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class PesertaMagangController extends Controller
{
public function store(Request $request, Divisi $divisi): RedirectResponse
{
    $validated = $request->validate([
        'nama'           => 'required|string|max:255',
        'asal_instansi'  => 'required|string|max:255',
        'jurusan'        => 'required|string|max:255',
        'no_hp'          => 'required|string|max:20',
        'email'          => 'nullable|email|max:255',
        'tanggal_mulai'  => 'required|date',
    ]);

    return DB::transaction(function () use ($validated, $divisi) {
        $divisi = Divisi::lockForUpdate()->findOrFail($divisi->id);

        if ($divisi->kuota_terpakai >= $divisi->kuota) {
            return redirect()
                ->route('peserta.riwayat')
                ->with('error', 'Kuota divisi sudah penuh, tidak bisa menerima peserta baru.');
        }

        PesertaMagang::create([
            ...$validated,
            'divisi_id' => $divisi->id,
            'status'    => 'Aktif',
        ]);

        $divisi->increment('kuota_terpakai');

        return redirect()
            ->route('peserta.riwayat')
            ->with('success', 'Data peserta berhasil disimpan, kuota terupdate.');
    });
}

    /**
     * "Magang Selesai?" -> Ya -> "Ubah Status -> Selesai" -> "Masuk Riwayat Magang"
     */
    public function selesaikan(PesertaMagang $peserta): RedirectResponse
    {
        DB::transaction(function () use ($peserta) {
            $peserta->update([
                'status'          => 'Selesai',
                'tanggal_selesai' => now(),
            ]);

            $peserta->divisi()->decrement('kuota_terpakai');
        });

        return redirect()
            ->route('peserta.riwayat')
            ->with('success', 'Status magang diubah menjadi selesai dan masuk riwayat.');
    }

    public function riwayat(): View
    {
        $riwayat = PesertaMagang::riwayat()->with('divisi')->latest('tanggal_selesai')->get();

        return view('peserta.riwayat', compact('riwayat'));
    }

    public function exportPdf()
    {
        $riwayat = PesertaMagang::riwayat()->with('divisi')->latest('tanggal_selesai')->get();

        $pdf = Pdf::loadView('peserta.riwayat-pdf', compact('riwayat'));

        return $pdf->download('riwayat-magang-' . now()->format('Y-m-d') . '.pdf');
    }
}