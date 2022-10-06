<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\CompanyController;

Route::group(['prefix' => 'accounts'], function() {
    Route::post('create',[CompanyController::class,'createAccount']);
    Route::get('getAll',[CompanyController::class,'getAllAccount']);
    Route::get('getById/{id}',[CompanyController::class,'getByAccountId']);
    Route::put('update',[CompanyController::class,'updateAccount']);
    Route::delete('delete/{id}',[CompanyController::class,'deleteAccount']);
    Route::put('restore/{id}',[CompanyController::class,'restoreByAccountId']);
});