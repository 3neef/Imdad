<?php

use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::middleware(['auth.apikey','auth:sanctum'])->prefix('products')->group(function() {

    Route::post('create',[ProductController::class,'createProduct']);
    Route::get('getAll',[ProductController::class,'getAllProducts']);
    Route::get('get-By-Id/{id}',[ProductController::class,'getByProductId']);
    Route::put('update',[ProductController::class,'updateProduct']);
    Route::delete('delete/{id}',[ProductController::class,'deleteProduct']);
    Route::put('restore/{id}',[ProductController::class,'restoreByProductId']);
});




Route::middleware(['auth.apikey','auth:sanctum'])->prefix('categories')->group(function() {

    Route::post('add', [CategoryController::class, 'addCatogry']);
    Route::post('aproved-catogry/{id}', [CategoryController::class, 'aprovedCatogry']);
    Route::get('show-all-approved-categories', [CategoryController::class, 'showAllAprovedCatogry']);
    Route::get('show-all-catogry', [CategoryController::class, 'showAllCatogry']);
    Route::post('save-sub-catogry', [CategoryController::class, 'addSubCatogry']);
    Route::get('show-with-catogry-id', [CategoryController::class, 'showWithCatogryId']);
    Route::post('aproved-sub-catogry/{id}', [CategoryController::class, 'aprovedSubCatogry']);
    Route::get('get-by-company-id/{companyId}', [CategoryController::class, 'getByCompany']);
});


Route::middleware(['auth.apikey','auth:sanctum'])->prefix('measures')->group(function() {
    Route::get('get-all-unit-of-measure',[CouponController::class,'Unit_of_measures']);
});

