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
use Spatie\Activitylog\Models\Activity;

Route::get('sendSms', [SmsController::class, 'sendSms']);

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::get('packages/get-supplier-packs', [SubscriptionController::class, 'getSupplierPackages']);
    Route::get('packages/get-buyer-packs', [SubscriptionController::class, 'getBuyerPackages']);
    Route::apiResource('packages', SubscriptionController::class);
    Route::put('packages/restore/{id}', [SubscriptionController::class, 'restore']);
});

// Route::apiResource('packages', SubscriptionController::class)->middleware('auth.apikey');


Route::group(['prefix' => 'installation'], function () {
    Route::get('migrate', [SubscriptionController::class, 'migration']);
    Route::get('seed', [SubscriptionController::class, 'seeder']);
    Route::get('fresh', [SubscriptionController::class, 'migrateFresh']);
    Route::get('apiKey', [SubscriptionController::class, 'apiKey']);
    Route::get('key', [SubscriptionController::class, 'key']);
});


Route::middleware(['auth.apikey'])->prefix('wathiq')->group(function () {
    Route::get('relatedCr', [WathiqController::class, 'getRelatedCompanies']);
});
Route::get('lookup-locations', [WathiqController::class, 'getLookupLocations']);
Route::get('optimize', function () {
    Artisan::call('optimize');
    dd("optimized successfully");
});

Route::get('route', function () {
    Artisan::call('route:list');
});

Route::get('Activity', function () {
    return Activity::all();
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('coupon', CouponController::class);
    Route::post('coupon/used', [CouponController::class, 'usedCoupon']);
    Route::put('coupon/restore/{id}', [CouponController::class, 'restore']);
});
Route::group(['prefix' => 'translation'], function () {
    Route::post('create', [TranslationController::class, 'Create']);
    Route::put('update', [TranslationController::class, 'Update']);
    Route::get('show', [TranslationController::class, 'Show']);
    Route::delete('delete', [TranslationController::class, 'Delete']);
});
