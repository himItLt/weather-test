<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Support\Facades\Route;

Route::get('search-api', [ForecastController::class, 'getFromApi']);
Route::get('search-db', [ForecastController::class, 'getFromDb']);
Route::post('store-forecast', [ForecastController::class, 'store']);

