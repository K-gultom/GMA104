<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\pegawaiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:','ceklevel:superadmin,admin'])->group(function () {});

Route::get('/', [authController::class, 'index'])->name('login');
Route::post('/', [authController::class, 'login_proses']);



Route::middleware(['auth:','cekLevel:superadmin,admin'])->group(function () {

    Route::get('/logout', [authController::class, 'logout']);

    Route::get('/dashboard', [dashboardController::class, 'index']);

    //pegawai
    Route::get('/pegawai', [pegawaiController::class, 'index']);

    Route::post('/pegawai/add', [pegawaiController::class, 'add_pegawai'])->name('add-pegawai');

    Route::get('/pegawai/edit/{id}', [pegawaiController::class, 'edit']);
    Route::post('/pegawai/edit/{id}', [pegawaiController::class, 'edit_pegawai']);

    
    Route::get('/data-a', [dashboardController::class, 'DataA']);

});
