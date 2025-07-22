<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardController::class)->middleware('auth');

    Route::get('/logout', [AuthenticationController::class, 'destroy']);
});
