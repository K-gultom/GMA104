<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\barangKeluarController;
use App\Http\Controllers\barangMasukController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\stokController;
use App\Http\Controllers\suplierController;
use App\Models\suplier;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:','ceklevel:superadmin,admin'])->group(function () {});

Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/', [authController::class, 'login_proses']);


Route::middleware(['auth:','cekLevel:superadmin,admin'])->group(function () {


    Route::get('/logout', [authController::class, 'logout']);

    Route::get('/dashboard', [dashboardController::class, 'index']);

//=========================================================================================================================
    /**
     * Routing untuk        
     */
    Route::controller(pegawaiController::class)->group(function(){

        Route::get('/pegawai', 'index');
        Route::post('/pegawai/add', 'add_pegawai')->name('add-pegawai');
        Route::get('/pegawai/edit/{id}', 'edit');
        Route::post('/pegawai/edit/{id}', 'edit_pegawai');

    });
    
//=========================================================================================================================
    /**
     * Routing Menu Stok
     */
    Route::controller(stokController::class)->group(function(){

        Route::get('/stok', 'index');
        Route::get('/stok/add', 'add');
        Route::post('/stok/add', 'add_proses');
        Route::get('/stok/edit/{id}', 'edit');
        Route::post('/stok/edit/{id}', 'edit_proses');
        Route::get('/stok/{id}', 'del');

    });
            
//=========================================================================================================================
    /**
     * Routing untuk Barang masuk
     */

     Route::controller(barangMasukController::class)->group(function(){

        Route::get('/barang-masuk', 'index');
        
        Route::get('/barang-masuk/add', 'create');
        Route::post('/barang-masuk/add', 'store')->name('saveData');
        
        Route::get('/barang-masuk/{id}', 'destroy');
     });
     
//=========================================================================================================================
    /**
     * Routing untuk Barang Keluar
     */
     Route::controller(barangKeluarController::class)->group(function () {
        Route::get('/barang-keluar', 'index');
            
        Route::get('/barang-keluar/add','create');
        Route::post('/barang-keluar/add','store'); 

        Route::post('/barang-keluar/save','saveProcess')->name('addBarangKeluar');

        Route::get('/barang-keluar/print/{id}','print');

        Route::get('/barang-keluar/{id}','destroy');
     });
     
//=========================================================================================================================
    /**
     * Routing Pelanggan
     */

     Route::controller(pelangganController::class)->group(function(){
        Route::get('/pelanggan','index');
        Route::get('/pelanggan/add','create');
        Route::post('/pelanggan/add','store');
        Route::get('/pelanggan/edit/{id}','edit');
        Route::post('/pelanggan/edit/{id}','update');
        Route::get('/pelanggan/{id}','destroy');

     });
        
//=========================================================================================================================
    /**
     * Routing Supplier
     */
    Route::controller(suplierController::class)->group(function(){
        Route::get('/suplier','index');
        Route::get('/suplier/add','add');
        Route::post('/suplier/add','add_Proses');
        Route::get('/suplier/edit/{id}','edit');
        Route::post('/suplier/edit/{id}','edit_Proses');
        Route::get('/suplier/{id}','del');

    });

//=========================================================================================================================
    /**
     * Routing Rekap Pelanggan
     */


});



// Routing for tes
Route::get('/data-a', [dashboardController::class, 'DataA']);
Route::post('/data-a', [dashboardController::class, 'data_getData']);

// Route::get('/testGetData', [dashboardController::class, 'testGetData']);
Route::post('/testGetData', [dashboardController::class, 'testGetData_Process'])->name('saveForm');


