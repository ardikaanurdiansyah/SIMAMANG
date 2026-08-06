<?php

namespace App\Http\Controllers;

use App\Models\PesertaMagang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PesertaMagangController extends Controller
{
    /**
     * "Magang Selesai?" -> Ya -> "Ubah Status -> Selesai" -> "Masuk Riwayat Magang"
     */
    public function selesaikan(PesertaMagang $peserta): RedirectResponse
    {
        DB::transaction(function () use ($peserta) {
            $peserta->update([
                'status'          => 'selesai',
                'tanggal_selesai' => now(),
            ]);

            $peserta->divisi()->decrement('kuota_terpakai');
        });

        return redirect()
            ->route('peserta.riwayat')
            ->with('success', 'Status magang diubah menjadi selesai dan masuk riwayat.');
    }

    /**
     * "Masuk Riwayat Magang"
     */
    public function riwayat(): View
    {
        $riwayat = PesertaMagang::riwayat()->with('divisi')->latest('tanggal_selesai')->get();

        return view('peserta.riwayat', compact('riwayat'));
    }
}