<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;

Route::apiResource('users', UserController::class);
Route::apiResource('routes', RoleController::class);