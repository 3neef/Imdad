<?php

use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {
    Route::apiResource('products',ProductController::class);
    Route::put('products/restore/{id}',[ProductController::class,'restore']);
});




Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {

    // Route::post('add', [CategoryController::class, 'addCatogry']);
    // Route::post('aproved-catogry/{id}', [CategoryController::class, 'aprovedCatogry']);
    // Route::get('show-all-approved-categories', [CategoryController::class, 'showAllAprovedCatogry']);
    // Route::get('show-all-catogry', [CategoryController::class, 'showAllCatogry']);
    // Route::post('save-sub-catogry', [CategoryController::class, 'addSubCatogry']);
    // Route::get('show-with-catogry-id', [CategoryController::class, 'showWithCatogryId']);
    // Route::post('aproved-sub-catogry/{id}', [CategoryController::class, 'aprovedSubCatogry']);
    // Route::get('get-by-company-id/{companyId}', [CategoryController::class, 'getByCompany']);


    Route::apiResource('categories',CategoryController::class);

});


Route::middleware(['auth.apikey','auth:sanctum'])->prefix('measures')->group(function() {
    Route::get('get-all-unit-of-measure',[CouponController::class,'Unit_of_measures']);
});

