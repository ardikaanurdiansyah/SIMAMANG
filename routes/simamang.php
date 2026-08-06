<?php

use App\Http\Controllers\PesertaMagangController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::patch('/peserta/{peserta}/selesai', [PesertaMagangController::class, 'selesaikan'])->name('peserta.selesai');
    Route::get('/riwayat', [PesertaMagangController::class, 'riwayat'])->name('peserta.riwayat');
});