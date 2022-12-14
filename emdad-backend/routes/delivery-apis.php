<?php

use App\Http\Controllers\DirverController;
use App\Http\Controllers\Profile\TruckController;
use Illuminate\Support\Facades\Route;



Route::middleware(['app.auth','auth:sanctum'])->group(function() {
    Route::apiResource('trucks',TruckController::class);
});

Route::middleware(['app.auth','auth:sanctum'])->group(function() {
    Route::apiResource('drivers',DirverController::class);
});

