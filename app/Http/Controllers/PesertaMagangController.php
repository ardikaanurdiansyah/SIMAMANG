<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\PesertaMagang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class PesertaMagangController extends Controller
{
    /**
     * Export PDF untuk satu peserta magang
     */
    public function exportPdf($id)
    {
        $peserta = PesertaMagang::with('divisi')->findOrFail($id);

        // Validasi - hanya peserta selesai yang bisa di-export
        if ($peserta->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Hanya peserta dengan status Selesai yang dapat di-export');
        }

        $data = [
            'peserta' => $peserta,
            'tanggal_cetak' => now()->format('d F Y'),
        ];

        // Sanitize filename - remove special characters
        $filename = preg_replace('/[^A-Za-z0-9\-_]/', '', str_replace(' ', '-', $peserta->nama));
        $pdf = Pdf::loadView('peserta.pdf', $data);
        return $pdf->download('sertifikat-' . $filename . '.pdf');
    }

    /**
     * Export PDF untuk satu peserta (view preview)
     */
    public function previewPdf($id)
    {
        $peserta = PesertaMagang::with('divisi')->findOrFail($id);

        // Validasi - hanya peserta selesai yang bisa di-preview
        if ($peserta->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Hanya peserta dengan status Selesai yang dapat di-preview');
        }

        $data = [
            'peserta' => $peserta,
            'tanggal_cetak' => now()->format('d F Y'),
        ];

        // Sanitize filename - remove special characters
        $filename = preg_replace('/[^A-Za-z0-9\-_]/', '', str_replace(' ', '-', $peserta->nama));
        $pdf = Pdf::loadView('peserta.pdf', $data);
        return $pdf->stream('sertifikat-' . $filename . '.pdf');
    }

    /**
     * Export PDF untuk semua peserta yang selesai
     */
    public function exportAllPdf()
    {
        $pesertaSelesai = PesertaMagang::with('divisi')
            ->where('status', 'Selesai')
            ->orderBy('nama', 'asc')
            ->get();

        if ($pesertaSelesai->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada peserta yang selesai');
        }

        $data = [
            'peserta' => $pesertaSelesai,
            'tanggal_cetak' => now()->format('d F Y'),
            'total_peserta' => $pesertaSelesai->count(),
        ];

        $pdf = Pdf::loadView('peserta.pdf-all', $data);
        $filename = 'laporan-peserta-magang-' . now()->format('Y-m-d-His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export PDF per divisi
     */
    public function exportByDivisiPdf($divisi_id)
    {
        $peserta = PesertaMagang::with('divisi')
            ->where('divisi_id', $divisi_id)
            ->where('status', 'Selesai')
            ->orderBy('nama', 'asc')
            ->get();

        if ($peserta->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada peserta selesai di divisi ini');
        }

        $divisiName = $peserta->first()->divisi->nama_divisi ?? 'Divisi';

        $data = [
            'peserta' => $peserta,
            'divisi_name' => $divisiName,
            'tanggal_cetak' => now()->format('d F Y'),
            'total_peserta' => $peserta->count(),
        ];

        // Sanitize divisi name for filename - remove special characters
        $safeFilename = preg_replace('/[^A-Za-z0-9\-_]/', '', str_replace(' ', '-', $divisiName));
        $pdf = Pdf::loadView('peserta.pdf-divisi', $data);
        $filename = 'laporan-peserta-' . $safeFilename . '-' . now()->format('Y-m-d-His') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Tampilkan halaman daftar peserta
     */
    public function index(): View
    {
        $peserta = PesertaMagang::with('divisi')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peserta.index', compact('peserta'));
    }

    /**
     * Tampilkan detail peserta
     */
    public function show($id): View
    {
        $peserta = PesertaMagang::with('divisi')->findOrFail($id);
        return view('peserta.show', compact('peserta'));
    }
}
=======
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
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d
