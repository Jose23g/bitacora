<?php

use App\Http\Controllers\logController;
use Illuminate\Support\Facades\Route;

Route::get('/', [logController::class, 'index'])->name('inicio');
Route::post('/registro', [logController::class, 'store'])->name('registro');
Route::post('/salida/{id}', [logController::class, 'marcarSalida'])->name('salida');

