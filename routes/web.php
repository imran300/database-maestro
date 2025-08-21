<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DatabasePerformanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/database/performance', [DatabasePerformanceController::class, 'index']);
