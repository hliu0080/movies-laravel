<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MoviesController::class, 'index']);
Route::post('/highestSalesTheater', [MoviesController::class, 'getHighestSalesTheater'])
    ->name('highestSalesTheater');
