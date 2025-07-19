<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::inertia('/dashboard', 'Dashboard')->middleware('auth');
});
