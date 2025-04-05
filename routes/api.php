<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\NotificationController;

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('permissions', PermissionController::class);
Route::apiResource('spaces', SpaceController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('activities', ActivityController::class);
Route::apiResource('notifications', NotificationController::class);