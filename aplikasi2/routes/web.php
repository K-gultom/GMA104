<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\barangMasukController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\suplierController;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:','ceklevel:superadmin,admin'])->group(function () {});

Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/', [authController::class, 'login_proses']);

// Routing for tes
Route::get('/data-a', [dashboardController::class, 'DataA']);


Route::middleware(['auth:','cekLevel:superadmin,admin'])->group(function () {

    Route::get('/logout', [authController::class, 'logout']);


    Route::get('/dashboard', [dashboardController::class, 'index']);



//=========================================================================================================================
    /**
     * Routing untuk        
     */
        Route::get('/pegawai', [pegawaiController::class, 'index']);

        Route::post('/pegawai/add', [pegawaiController::class, 'add_pegawai'])->name('add-pegawai');

        Route::get('/pegawai/edit/{id}', [pegawaiController::class, 'edit']);
        Route::post('/pegawai/edit/{id}', [pegawaiController::class, 'edit_pegawai']);

    
//=========================================================================================================================
    /**
     * Routing Menu Stok
     */
        Route::get('/stok', [stokController::class, 'index']);

        Route::get('/stok/add', [stokController::class, 'add']);
        Route::post('/stok/add', [stokController::class, 'add_proses']);

        Route::get('/stok/edit/{id}', [stokController::class, 'edit']);
        Route::post('/stok/edit/{id}', [stokController::class, 'edit_proses']);

        Route::get('/stok/{id}', [stokController::class, 'del']);


    
//=========================================================================================================================
    /**
     * Routing untuk Barang masuk
     */
        Route::get('/barang-masuk', [barangMasukController::class, 'index']);

        Route::get('/barang-masuk/add', [barangMasukController::class, 'create']);
        Route::post('/barang-masuk/add', [barangMasukController::class, 'store'])->name('saveData');
        
     
//=========================================================================================================================
    /**
     * Routing untuk Barang Keluar
     */


     
//=========================================================================================================================
    /**
     * Routing Pelanggan
     */
        Route::get('/pelanggan', [pelangganController::class, 'index']);

        Route::get('/pelanggan/add', [pelangganController::class, 'add']);
        Route::post('/pelanggan/add', [pelangganController::class, 'add_Proses']);

        Route::get('/pelanggan/edit/{id}', [pelangganController::class, 'edit']);
        Route::post('/pelanggan/edit/{id}', [pelangganController::class, 'edit_Proses']);
        
        Route::get('/pelanggan/{id}', [pelangganController::class, 'delete']);


//=========================================================================================================================
    /**
     * Routing Supplier
     */

        Route::get('/suplier', [suplierController::class, 'index']);

        Route::get('/suplier/add', [suplierController::class, 'add']);
        Route::post('/suplier/add', [suplierController::class, 'add_Proses']);

        Route::get('/suplier/edit/{id}', [suplierController::class, 'edit']);
        Route::post('/suplier/edit/{id}', [suplierController::class, 'edit_Proses']);

        Route::get('/suplier/{id}', [suplierController::class, 'del']);


//=========================================================================================================================
    /**
     * Routing Nota Penjualan
     */


     
//=========================================================================================================================
    /**
     * Routing Rekap Pelanggan
     */



});
