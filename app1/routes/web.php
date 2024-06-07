<?php

use App\Http\Controllers\firstController;
use App\Http\Controllers\secondController;
use Illuminate\Support\Facades\Route;


Route::get('/', [firstController::class, 'index']);

Route::get('/first', [firstController::class, 'first']);

Route::get('/info', [firstController::class, 'info']);

Route::get('/operasi', [secondController::class, 'operasi']);

