<?php

use App\Http\Controllers\PesertaMagangController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD

Route::get('/', function () {
    return redirect()->route('peserta.riwayat');
});

Route::get('/dashboard', [PesertaMagangController::class, 'dashboard'])->name('dashboard');
=======
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209

Route::prefix('peserta')->name('peserta.')->group(function () {

    Route::get('/create', [PesertaMagangController::class, 'create'])->name('create');

    Route::post('/store', [PesertaMagangController::class, 'store'])->name('store');

<<<<<<< HEAD
    Route::get('/riwayat', [PesertaMagangController::class, 'riwayat'])->name('riwayat');

    Route::patch('/selesaikan/{peserta}', [PesertaMagangController::class, 'selesaikan'])->name('selesaikan');

    Route::get('/export-pdf/{id}', [PesertaMagangController::class, 'exportPdf'])->name('export-pdf');
});
=======
Route::get('/', fn () => redirect()->route('dashboard'));
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
