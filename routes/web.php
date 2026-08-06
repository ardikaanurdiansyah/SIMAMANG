<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesertaMagangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaMagangController;
use App\Http\Middleware\EnsureUserIsAdmin;

<<<<<<< HEAD
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
=======
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [PesertaMagangController::class, 'dashboard'])->name('dashboard');

    Route::get('/peserta/create', [PesertaMagangController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaMagangController::class, 'store'])->name('peserta.store');
});

Route::get('/', fn () => redirect()->route('dashboard'));
>>>>>>> 74d6e0a602ef39447fd7411dfd619cf6786e927d
