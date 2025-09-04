<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
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
        Route::delete('{id}', [BookingController::class, 'removeBooking']);
    });
});

Route::middleware('auth:sanctum')->prefix('destinations')->group(function () {
    Route::get('all', [DestinationController::class, 'getAllDestination']);
    Route::get('{slug}', [DestinationController::class, 'showDestination']);
    Route::middleware('role:admin')->group(function () {
        Route::post('add', [DestinationController::class, 'addDestination']);
        Route::delete('{id}', [DestinationController::class, 'deleteDestination']);
        Route::put('{id}', [DestinationController::class, 'updateDestination']);
    });
});

Route::middleware('auth:sanctum')->prefix('packages')->group(function () {
    Route::get('all', [PackageController::class, 'getAllPackage']);
    Route::get('{id}', [PackageController::class, 'showPackage']);
    Route::middleware('role:admin')->group(function () {
        Route::post('add', [PackageController::class, 'addPackage']);
        Route::put('{id}', [PackageController::class, 'updatePackage']);
        Route::delete('{id}', [PackageController::class, 'deletePackage']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('payments', [PaymentController::class, 'createPayment']);
});
