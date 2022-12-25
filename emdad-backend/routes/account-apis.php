<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\WarehousesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPaymentController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::get('checkSubscriptionPayment', [SubscriptionPaymentController::class, 'check_subscription_payment']);
    // Route::get('profiles/filter',[ProfileController::class,'filter']);
    Route::put('profiles/swap/{id}', [ProfileController::class, 'swap_profile']);

    Route::get('profiles/pay', [SubscriptionPaymentController::class, "pay"]);
    Route::apiResource('profiles/subscriptionPayment', SubscriptionPaymentController::class);

    Route::apiResource('profiles', ProfileController::class);
    Route::put('profiles/restore/{id}', [ProfileController::class, 'restoreByAccountId']);
});
Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('warehouses')->group(function () {
    Route::put('verfied/{id}', [WarehousesController::class, 'verfiedLocation']);
    Route::put('restore/{id}', [WarehousesController::class, 'restoreByLocationId']);
});
Route::apiResource('warehouses', WarehousesController::class)->middleware(['auth.apikey', 'auth:sanctum']);
