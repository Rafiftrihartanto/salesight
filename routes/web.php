<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdasController;
use App\Http\Controllers\KontribusiTokoController;
use App\Http\Controllers\TrenPenjualanTokoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
// Landing Page
Route::get('/', function () {
    return view('landing.landing');
});

// AUTH
Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::get('/register', function () {
    return view('register.register');
})->name('register');

// OWNER
Route::prefix('owner')->group(function () {

    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');

    Route::get('/tren-global', function () {
        return view('owner.tren-penjualan-global');
    })->name('owner.tren-global');

    Route::get(
        '/tren-penjualan-toko',
        [TrenPenjualanTokoController::class, 'trenPenjualanToko']
    )->name('owner.tren-toko');

    Route::get(
        '/kontribusi-toko/{tahun?}',
        [KontribusiTokoController::class, 'kontribusiToko']
    )->name('owner.kontribusi-toko');

    Route::get('/kelola-cabang', function () {
        return view('owner.kelola-cabang');
    })->name('owner.kelola-cabang');

    Route::get('/daftar-toko', function () {
        return view('owner.daftar-toko');
    })->name('owner.daftar-toko');
});

// ADMIN
Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get(
        '/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');

    // Data Transaksi
    Route::get(
        '/data-transaksi',
        [AdminController::class, 'dataTransaksi']
    )->name('admin.data-transaksi');

    // Laporan
    Route::get(
        '/laporan',
        [AdminController::class, 'laporan']
    )->name('admin.laporan');

    // Form Input Data
    Route::get(
        '/input-data',
        [TransaksiController::class, 'create']
    )->name('admin.input-data');

    // Simpan Data
    Route::post(
        '/simpan-data',
        [TransaksiController::class, 'store']
    )->name('admin.store');

    // Edit Data
    Route::get(
        '/edit-data/{id}',
        [TransaksiController::class, 'edit']
    )->name('admin.edit');

    // Update Data
    Route::put(
        '/update-data/{id}',
        [TransaksiController::class, 'update']
    )->name('admin.update');

    // Hapus Data
    Route::delete(
        '/hapus-data/{id}',
        [TransaksiController::class, 'destroy']
    )->name('admin.delete');
});
// EDAS
Route::get(
    '/proses-edas/{tahun}',
    [KontribusiTokoController::class, 'prosesEdas']
);

// FORWARD CHAINING
Route::get(
    '/proses-status-toko/{yearAwal}/{yearAkhir}',
    [TrenPenjualanTokoController::class, 'prosesStatusToko']
);
