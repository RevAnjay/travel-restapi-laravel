<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->prefix('bookings')->group(function() {
    Route::post('create', [BookingController::class, 'createBooking']);
    Route::post('get', [BookingController::class, 'getBooking']);
    Route::middleware('role:admin')->group(function () {
        Route::post('all', [BookingController::class, 'getAllBooking']);
        Route::post('remove', [BookingController::class, 'removeBooking']);
    });
});

Route::middleware('auth:sanctum')->prefix('destinations')->group(function () {
    Route::post('add', [DestinationController::class, 'addDestination'])->middleware('role:admin');
    Route::get('all', [DestinationController::class, 'getAllDestination']);
});

Route::middleware('auth:sanctum')->prefix('packages')->group(function () {
    Route::post('add', [PackageController::class, 'addPackages'])->middleware('role:admin');
    Route::get('all', [PackageController::class, 'getAllPackage']);
});
