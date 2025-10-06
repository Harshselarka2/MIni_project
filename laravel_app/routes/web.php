<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', [WeatherController::class, 'index']);
Route::post('/search', [WeatherController::class, 'search'])->name('search');
Route::view('/about', 'about');
