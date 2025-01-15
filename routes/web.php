<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\UserController;

Route::prefix('super-user')->name('superuser.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SuperUserController::class, 'jumlahBarang'])->name('dashboard');
    
    // Barang Inventaris
    Route::get('/daftar-barang', [BarangInventarisController::class, 'DBarang'])->name('daftarBarang');
    Route::get('/penerimaan-barang', [BarangInventarisController::class, 'PBarang'])->name('penerimaanBarang');
    Route::post('/penerimaan-barang/store', [BarangInventarisController::class, 'barangStore'])->name('barangStore');
    
    // Peminjaman Barang
    Route::get('/peminjaman-barang', [PeminjamanBarangController::class, 'peminjamanBarang'])->name('peminjamanBarang');
    Route::post('/peminjaman-barang/store', [PeminjamanBarangController::class, 'simpanPeminjamanBarang'])->name('simpanPeminjamanBarang');

    // Pengembalian
    Route::get('/pengembalian-barang', [PengembalianController::class,'index'])->name('pengembalianBarang');
    Route::get('/pengembalian-barang', [PengembalianController::class, 'formPengembalian'])->name('pengembalianBarang');
    Route::post('/pengembalian-barang/store', [PengembalianController::class, 'simpanPengembalian'])->name('pengembalianBarang.store');


    // Laporan
    Route::get('/laporan-barang', [LaporanBarangController::class, 'laporanBarang'])->name('laporanBarang');
    Route::get('/laporan-peminjaman', [LaporanBarangController::class, 'laporanPeminjaman'])->name('laporanPeminjaman');
    
    // Referensi
    Route::get('/jenis-barang', [ReferensiController::class, 'jenisBarang'])->name('jenisBarang');
    Route::get('/daftar-pengguna', [ReferensiController::class, 'daftarPengguna'])->name('daftarPengguna');
});

