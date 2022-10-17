<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\CompanyController;
use App\Http\Controllers\Accounts\LocationController;

Route::group(['prefix' => 'accounts'], function() {
    Route::post('create',[CompanyController::class,'createAccount']);
    Route::get('getAll',[CompanyController::class,'getAllAccount']);
    Route::get('getById/{id}',[CompanyController::class,'getByAccountId']);
    Route::put('update',[CompanyController::class,'updateAccount']);
    Route::delete('delete/{id}',[CompanyController::class,'deleteAccount']);
    Route::put('restore/{id}',[CompanyController::class,'restoreByAccountId']);
});

Route::group(['prefix' => 'warehouses'], function() {
    Route::post('create',[LocationController::class,'saveLocation']);
    Route::get('getAll',[LocationController::class,'getAllLocations']);
    Route::get('getById/{id}',[LocationController::class,'getByLocationById']);
    Route::get('getByUserId/{userId}',[LocationController::class,'getByLocationByUserId']);
    Route::get('getByCompanyId/{companyId}',[LocationController::class,'getByLocationByCompanyId']);
    Route::put('update',[LocationController::class,'updateLocation']);
    Route::delete('delete/{id}',[LocationController::class,'deleteLocation']);
    Route::put('restore/{id}',[LocationController::class,'restoreByLocationId']);
});