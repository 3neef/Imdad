<?php

use App\Http\Controllers\Accounts\SubscriptionController;
use App\Http\Controllers\emdad\WathiqController;
use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\Translatoin\TranslationController;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('sendSms', [SmsController::class, 'sendSms']);

Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('subscriptions')->group(function () {
    Route::put('update', [SubscriptionController::class, 'updateSubscription']);
    Route::post('create', [SubscriptionController::class, 'createPackage']);
    Route::get('get-supplier-packs', [SubscriptionController::class, 'getSupplierPackages']);
    Route::get('get-buyer-packs', [SubscriptionController::class, 'getBuyerPackages']);
});



Route::group(['prefix' => 'installation'], function () {
    Route::get('migrate', [SubscriptionController::class, 'migration']);
    Route::get('seed', [SubscriptionController::class, 'seeder']);
    Route::get('fresh', [SubscriptionController::class, 'migrateFresh']);
});


Route::middleware(['auth.apikey'])->prefix('wathiq')->group(function () {
    Route::get('relatedCr', [WathiqController::class, 'getRelatedCompanies']);
});
    Route::get('optimize',function(){
        Artisan::call('optimize');
        dd("optimized successfully");
    });

Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('coupon')->group(function () {
    Route::post('create', [CouponController::class, 'createCoupon']);
    Route::get('show', [CouponController::class, 'showCoupon']);
    Route::post('used', [CouponController::class, 'usedCoupon']);
});





Route::group(['prefix' => 'translation'],function(){
    Route::post('create', [TranslationController::class, 'Create']);
    Route::put('update', [TranslationController::class, 'Update']);
    Route::get('show', [TranslationController::class, 'Show']);
    Route::delete('delete', [TranslationController::class, 'Delete']);



});
