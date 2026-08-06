<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaMagangController;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/', function () {
    return redirect()->route('peserta.index');
});

// Routes untuk Peserta Magang
Route::prefix('peserta')->group(function () {
    // Tampilkan daftar peserta
    Route::get('/', [PesertaMagangController::class, 'index'])->name('peserta.index');
    
    // Tampilkan detail peserta
    Route::get('/{id}', [PesertaMagangController::class, 'show'])->name('peserta.show');
    
    // Export PDF Routes
    Route::middleware([EnsureUserIsAdmin::class])->group(function () {
        // Export sertifikat untuk satu peserta (download)
        Route::get('/{id}/export-pdf', [PesertaMagangController::class, 'exportPdf'])->name('peserta.export-pdf');
        
        // Preview PDF untuk satu peserta (view in browser)
        Route::get('/{id}/preview-pdf', [PesertaMagangController::class, 'previewPdf'])->name('peserta.preview-pdf');
        
        // Export PDF semua peserta yang selesai
        Route::get('/export-all/pdf', [PesertaMagangController::class, 'exportAllPdf'])->name('peserta.export-all-pdf');
        
        // Export PDF peserta per divisi
        Route::get('/export-divisi/{divisi_id}/pdf', [PesertaMagangController::class, 'exportByDivisiPdf'])->name('peserta.export-divisi-pdf');
    });
});