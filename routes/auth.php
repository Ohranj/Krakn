<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Login');
Route::post('/login', [AuthenticationController::class, 'login'])->middleware(['throttle:login']);
