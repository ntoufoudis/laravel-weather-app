<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'search'])->name('search');
//Route::get('/error/{code}', [HomeController::class, 'showError'])->name('error');
