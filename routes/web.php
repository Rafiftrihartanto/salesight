<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontribusiTokoController;
use App\Http\Controllers\TrenPenjualanTokoController;

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

    Route::get('/kontribusi-toko/{tahun?}', [KontribusiTokoController::class, 'kontribusiToko'])
        ->name('owner.kontribusi-toko');

    Route::get('/kelola-cabang', function () {
        return view('owner.kelola-cabang');
    })->name('owner.kelola-cabang');

    Route::get('/daftar-toko', function () {
        return view('owner.daftar-toko');
    })->name('owner.daftar-toko');

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
