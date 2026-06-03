<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdasController;
use App\Http\Controllers\KontribusiTokoController;
use App\Http\Controllers\TrenPenjualanTokoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController; // Tambahan import agar tidak error

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

// Hanya 1 Prefix, dan semua rute owner dilindungi Middleware Auth
Route::prefix('owner')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');

    // Tren Global
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
  
    // Kelola Cabang (Rute statis yang lama sudah dihapus)
    Route::get('/kelola-cabang', [BranchController::class, 'index'])->name('owner.kelola-cabang');
    Route::post('/kelola-cabang', [BranchController::class, 'store'])->name('owner.kelola-cabang.store');
    Route::put('/kelola-cabang/{id}', [BranchController::class, 'update'])->name('owner.kelola-cabang.update');
    Route::delete('/kelola-cabang/{id}', [BranchController::class, 'destroy'])->name('owner.kelola-cabang.destroy');

    // Daftar Toko
    Route::get('/daftar-toko', function () {
        return view('owner.daftar-toko');
    })->name('owner.daftar-toko');
});

// ADMIN
Route::prefix('admin')->group(function () {

/*
|--------------------------------------------------------------------------
| EDAS
|--------------------------------------------------------------------------
*/

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