<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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

=======
use App\Models\PesertaMagang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class PesertaMagangController extends Controller
{
    /**
     * Export PDF untuk satu peserta magang
     */
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
    public function exportPdf($id)
    {
        $peserta = PesertaMagang::with('divisi')->findOrFail($id);

<<<<<<< HEAD
        $pdf = Pdf::loadView(
            'peserta.pdf-single',
            compact('peserta')
        );

        return $pdf->download(
            'peserta-magang-' . str()->slug($peserta->nama) . '.pdf'
        );
    }
}
=======
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
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
