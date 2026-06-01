<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdasController;
use App\Http\Controllers\ForwardController;

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
Route::get('/login', function () {
    return view('login.login');
})->name('login');

// REGISTER
Route::get('/register', function () {
    return view('register.register');
})->name('register');


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
    [ForwardController::class, 'trenPenjualanToko']
    )->name('owner.tren-toko');

    Route::get(
        '/kontribusi-toko/{tahun?}',
        [EdasController::class, 'kontribusiToko']
    )->name('owner.kontribusi-toko');
});

/*
|--------------------------------------------------------------------------
| EDAS
|--------------------------------------------------------------------------
*/

Route::get('/proses-edas/{tahun}',
    [EdasController::class, 'prosesEdas']);

/*
|--------------------------------------------------------------------------
| FORWARD CHAINING
|--------------------------------------------------------------------------
*/

Route::get(
    '/proses-status-toko/{yearAwal}/{yearAkhir}',
    [ForwardController::class, 'prosesStatusToko']
);