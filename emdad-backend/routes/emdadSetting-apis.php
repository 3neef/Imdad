<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\BrandController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('brands', BrandController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('colors', BrandController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('models', BrandController::class);
});
