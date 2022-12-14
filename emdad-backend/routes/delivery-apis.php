<?php

use App\Http\Controllers\Profile\DriverController;
use App\Http\Controllers\Profile\TruckController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {
    Route::apiResource('trucks',TruckController::class);
});

Route::middleware(['auth.apikey','auth:sanctum'])->prefix('trucks')->group(function() {
    Route::put('restore/{id}', [TruckController::class, 'restoretruck']);
});


Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {
    Route::apiResource('dirvers',DriverController::class);
    Route::put('dirvers/restore/{id}', [DriverController::class, 'restore']);

});