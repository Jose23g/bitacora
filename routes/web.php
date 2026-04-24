<?php

use App\Http\Controllers\logController;
use Illuminate\Support\Facades\Route;

Route::get('/', [logController::class, 'index'])->name('inicio');
