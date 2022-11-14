<?php

use App\Http\Controllers\Accounts\SubscriptionController;
use App\Http\Controllers\emdad\WathiqController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::middleware("auth:sanctum")->group( function() {
});
Route::get('sendSms',[SmsController::class,'sendSms']);

Route::group(["prefix"=>"subscriptions"], function ( )
{
    Route::put('update',[SubscriptionController::class,'updateSubscription']);
    Route::post('create',[SubscriptionController::class,'createPackage']);
    Route::get('get-supplier-packs',[SubscriptionController::class,'getSupplierPackages']);
    Route::get('get-buyer-packs',[SubscriptionController::class,'getBuyerPackages']);
        Route::get('subscriptionPayment',[SubscriptionPaymentController::class,'AddSubscriptionPayment']);
});
    


Route::group(['prefix' => 'installation'], function() {

    Route::get('migrate',[SubscriptionController::class,'migration']);
    Route::get('seed',[SubscriptionController::class,'seeder']);
    Route::get('fresh',[SubscriptionController::class,'migrateFresh']);
});


Route::group(['prefix' => 'wathiq'], function() {

    Route::get('relatedCr',[WathiqController::class,'getRelatedCompanies']);
   
});


