<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PesertaMagangController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [PesertaMagangController::class, 'dashboard'])->name('dashboard');

    Route::get('/peserta/create', [PesertaMagangController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaMagangController::class, 'store'])->name('peserta.store');
});

Route::get('/', fn () => redirect()->route('dashboard'));
