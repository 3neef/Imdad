<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\WarehousesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPaymentController;

Route::middleware(['app.auth','auth:sanctum'])->group(function() {
    Route::apiResource('profiles',ProfileController::class);

    Route::put('profiles/restore/{id}', [ProfileController::class, 'restoreByAccountId']);

    Route::get('subscriptionPayment', [SubscriptionPaymentController::class, 'AddSubscriptionPayment']);
});


Route::middleware(['app.auth','auth:sanctum'])->prefix('warehouses')->group(function() {
    Route::put('verfied/{id}', [WarehousesController::class, 'verfiedLocation']);
    Route::put('restore/{id}', [WarehousesController::class, 'restoreByLocationId']);
});


Route::apiResource('warehouses',WarehousesController::class)->middleware(['app.auth', 'auth:sanctum']);

