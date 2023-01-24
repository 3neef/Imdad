<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\BrandController;
use App\Http\Controllers\Settings\ColorController;
use App\Http\Controllers\Settings\ModelController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('brands', BrandController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('colors', ColorController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('models', ModelController::class);
});
