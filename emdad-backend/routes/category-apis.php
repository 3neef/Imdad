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
    Route::post('SaveCatogry', [CategoryController::class, 'addCatogry']);
    Route::post('aprovedcatogre/{id}', [CategoryController::class, 'aprovedcatogre']);
    Route::get('show-all-approved-categories', [CategoryController::class, 'showallaprovedcatogre']);
    Route::get('showallcatogre', [CategoryController::class, 'showallcatogre']);
    Route::post('SavesubCatogre', [CategoryController::class, 'addsubCatogre']);
    Route::post('showwithcatogreid', [CategoryController::class, 'showwithcatogreid']);
    Route::post('aprovedsubcatogre/{id}', [CategoryController::class, 'aprovedsubcatogre']);
    Route::get('getByCompanyId/{companyId}', [CategoryController::class, 'getByCompany']);
});


