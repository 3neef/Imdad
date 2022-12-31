<?php

use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::put('products/restore/{id}', [ProductController::class, 'restore']);
    Route::post('products/company-products', [ProductController::class, 'setCompanyProduct']);
});




Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::put('categories/restore/{id}', [CategoryController::class, 'restore']);
    Route::put('categories/reset-category/{id}', [CategoryController::class, 'reset']);

});


Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('measures')->group(function () {
    Route::get('get-all-unit-of-measure', [CouponController::class, 'Unit_of_measures']);
});
