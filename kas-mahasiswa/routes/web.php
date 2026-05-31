<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengajuanRabController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware('role:bendahara')->group(function () {
        Route::resource('anggota', AnggotaController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('transaksi', TransaksiController::class);
    });

    Route::resource('pengajuan-rab', PengajuanRabController::class);
    Route::post('/pengajuan-rab/{id}/verifikasi', [PengajuanRabController::class, 'verifikasi'])->name('pengajuan-rab.verifikasi')->middleware('role:bendahara');
    Route::post('/pengajuan-rab/{id}/persetujuan', [PengajuanRabController::class, 'persetujuan'])->name('pengajuan-rab.persetujuan')->middleware('role:ketua');
    Route::post('/pengajuan-rab/{id}/cairkan', [PengajuanRabController::class, 'cairkan'])->name('pengajuan-rab.cairkan')->middleware('role:bendahara');
});