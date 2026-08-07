<?php

namespace App\Http\Controllers;

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
