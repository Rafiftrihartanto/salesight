<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontribusiTokoController;
use App\Http\Controllers\TrenPenjualanTokoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;

// Landing Page
Route::get('/', function () {
    return view('landing.landing');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/

// Hanya 1 Prefix, dan semua rute owner dilindungi Middleware Auth
Route::prefix('owner')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');

    // Tren Global
    Route::get('/tren-global', function () {
        return view('owner.tren-penjualan-global');
    })->name('owner.tren-global');

    // Tren Toko
    Route::get('/tren-penjualan-toko', [TrenPenjualanTokoController::class, 'trenPenjualanToko'])
        ->name('owner.tren-toko');

    // Kontribusi
    Route::get('/kontribusi-toko/{tahun?}', [KontribusiTokoController::class, 'kontribusiToko'])
        ->name('owner.kontribusi-toko');

    // Kelola Cabang
    Route::get('/kelola-cabang', [BranchController::class, 'index'])->name('owner.kelola-cabang');
    Route::post('/kelola-cabang', [BranchController::class, 'store'])->name('owner.kelola-cabang.store');
    Route::put('/kelola-cabang/{id}', [BranchController::class, 'update'])->name('owner.kelola-cabang.update');
    Route::delete('/kelola-cabang/{id}', [BranchController::class, 'destroy'])->name('owner.kelola-cabang.destroy');

    // Daftar Toko
    Route::get('/daftar-toko', function () {
        return view('owner.daftar-toko');
    })->name('owner.daftar-toko');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

// Rute khusus untuk Admin, dilindungi oleh middleware auth
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Dashboard Admin 
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    //DATA TRANSAKSI
    Route::get('/data-transaksi', function () {
        return view('admin.data-transaksi'); 
    })->name('admin.transaksi');

    //
    Route::get('/input-data', function () {
        return view('admin.input-data'); 
    })->name('admin.input');
});


/*
|--------------------------------------------------------------------------
| EDAS
|--------------------------------------------------------------------------
*/

Route::get('/proses-edas/{tahun}', [KontribusiTokoController::class, 'prosesEdas']);

/*
|--------------------------------------------------------------------------
| FORWARD CHAINING
|--------------------------------------------------------------------------
*/

Route::get(
    '/proses-status-toko/{yearAwal}/{yearAkhir}',
    [TrenPenjualanTokoController::class, 'prosesStatusToko']
);