<?php

use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::group(['prefix' => 'products'], function() {
    Route::post('create',[ProductController::class,'createProduct']);
    Route::get('getAll',[ProductController::class,'getAllProducts']);
    Route::get('getById/{id}',[ProductController::class,'getByProductId']);
    Route::put('update',[ProductController::class,'updateProduct']);
    Route::delete('delete/{id}',[ProductController::class,'deleteProduct']);
    Route::put('restore/{id}',[ProductController::class,'restoreByProductId']);
});

Route::group(['prefix' => 'categories'], function() {
    Route::post('add', [CategoryController::class, 'addCatogry']);
    Route::post('aprovedcategory/{id}', [CategoryController::class, 'aprovedcategory']);
    Route::get('show-all-approved-categories', [CategoryController::class, 'showallaprovedcategory']);
    Route::get('showallcategory', [CategoryController::class, 'showallcategory']);
    Route::post('Savesubcategory', [CategoryController::class, 'addsubcategory']);
    Route::post('showwithcategoryid', [CategoryController::class, 'showwithcategoryid']);
    Route::post('aprovedsubcategory/{id}', [CategoryController::class, 'aprovedsubcategory']);
    Route::get('getByCompanyId/{companyId}', [CategoryController::class, 'getByCompany']);
});


