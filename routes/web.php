<?php

use App\Http\Controllers\PesertaMagangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('peserta.riwayat');
});

Route::get('/dashboard', [PesertaMagangController::class, 'dashboard'])->name('dashboard');

Route::prefix('peserta')->name('peserta.')->group(function () {

    Route::get('/create', [PesertaMagangController::class, 'create'])->name('create');

    Route::post('/store', [PesertaMagangController::class, 'store'])->name('store');

    Route::get('/riwayat', [PesertaMagangController::class, 'riwayat'])->name('riwayat');

    Route::patch('/selesaikan/{peserta}', [PesertaMagangController::class, 'selesaikan'])->name('selesaikan');

    Route::get('/export-pdf/{id}', [PesertaMagangController::class, 'exportPdf'])->name('export-pdf');
});