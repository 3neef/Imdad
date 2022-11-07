<?php

use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::group(['prefix' => 'products'], function() {
    Route::post('create',[ProductController::class,'createProduct']);
    Route::get('getAll',[ProductController::class,'getAllProducts']);
    Route::get('get-By-Id/{id}',[ProductController::class,'getByProductId']);
    Route::put('update',[ProductController::class,'updateProduct']);
    Route::delete('delete/{id}',[ProductController::class,'deleteProduct']);
    Route::put('restore/{id}',[ProductController::class,'restoreByProductId']);
});

Route::group(['prefix' => 'categories'], function() {
    Route::post('add', [CategoryController::class, 'addCatogry']);
    Route::post('aproved-catogry/{id}', [CategoryController::class, 'aprovedCatogry']);
    Route::get('show-all-approved-categories', [CategoryController::class, 'showAllAprovedCatogry']);
    Route::get('show-all-catogry', [CategoryController::class, 'showAllCatogry']);
    Route::post('save-sub-catogry', [CategoryController::class, 'addSubCatogry']);
    Route::get('show-with-catogry-id', [CategoryController::class, 'showWithCatogryId']);
    Route::post('aproved-sub-catogry/{id}', [CategoryController::class, 'aprovedSubCatogry']);
    Route::get('get-by-company-id/{companyId}', [CategoryController::class, 'getByCompany']);
});


