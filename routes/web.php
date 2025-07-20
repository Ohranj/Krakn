<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::inertia('/dashboard', 'Dashboard')->middleware('auth');

    Route::get('/logout', [AuthenticationController::class, 'destroy']);
});
