<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherController;

Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{id}/weather', [WeatherController::class, 'show']);
