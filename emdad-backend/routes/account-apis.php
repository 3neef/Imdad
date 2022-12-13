<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPaymentController;

Route::middleware(['app.auth','auth:sanctum'])->group(function() {
    Route::apiResource('profiles',ProfileController::class);

    Route::put('profiles/restore/{id}', [ProfileController::class, 'restoreByAccountId']);

    Route::get('subscriptionPayment', [SubscriptionPaymentController::class, 'AddSubscriptionPayment']);
});


Route::middleware(['app.auth','auth:sanctum'])->prefix('warehouses')->group(function() {
    Route::put('verfied', [LocationController::class, 'verfiedLocation']);
    Route::put('restore/{id}', [LocationController::class, 'restoreByLocationId']);
});


Route::apiResource('warehouses',LocationController::class)->middleware(['app.auth', 'auth:sanctum']);

