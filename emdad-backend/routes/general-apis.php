<?php

use App\Http\Controllers\Accounts\SubscriptionController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group( function() {
});
Route::get('sendSms',[SmsController::class,'sendSms']);

Route::group(["prefix"=>"subscriptions"], function ( )
{
    Route::put('update',[SubscriptionController::class,'updateSubscription']);
    Route::post('create',[SubscriptionController::class,'createPackage']);
    Route::get('get-supplier-packs',[SubscriptionController::class,'getSupplierPackages']);
    Route::get('get-buyer-packs',[SubscriptionController::class,'getBuyerPackages']);
    
});

