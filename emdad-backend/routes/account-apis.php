<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\CompanyController;
use App\Http\Controllers\Accounts\LocationController;
use App\Http\Controllers\Accounts\SubscriptionController;

Route::group(['prefix' => 'accounts'], function() {
    Route::post('create',[CompanyController::class,'createAccount']);
    Route::get('getAll',[CompanyController::class,'getAllAccount']);
    Route::get('getAllUnValidated',[CompanyController::class,'allUnValidatedAccounts']);
    Route::put('validate/{id}',[CompanyController::class,'validatedAccount']);
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
    Route::put('verfied',[LocationController::class,'verfiedLocation']);
    Route::delete('delete/{id}',[LocationController::class,'deleteLocation']);
    Route::put('restore/{id}',[LocationController::class,'restoreByLocationId']);
});

Route::group(['prefix' => 'subscriptions'], function() {
    Route::put('update',[SubscriptionController::class,'updateSubscription']);
});