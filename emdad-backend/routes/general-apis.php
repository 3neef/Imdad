<?php

use App\Http\Controllers\Accounts\SubscriptionController;
use App\Http\Controllers\SmsController;
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
    
});


Route::group(['prefix' => 'installtion'], function() {
    /**
        * @OA\get(
        * path="/api/v1_0/installtion/migrate",
        * operationId="migrateDb",
        * tags={"General"},

        * summary="migrate db",
        * description="migrate db Here",
        *      @OA\Response(
        *        response=200,
        *          description="",
        *         @OA\JsonContent(
        *         @OA\Property(property="message", type="string", example="{'message': "Migrate Command run succssfly"}")
        *          ),
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    Route::get('migrate',function(){
    Artisan::call('migrate:fresh');
    dd("Migrate Command run succssfly");
    });
        /**
        * @OA\get(
        * path="/api/v1_0/installtion/seed",
        * operationId="seederDb",
        * tags={"General"},

        * summary="seeder db",
        * description="seeder db Here",
        *      @OA\Response(
        *        response=200,
        *          description="",
        *         @OA\JsonContent(
        *         @OA\Property(property="message", type="string", example="{'message': "seeder Command run succssfly"}")
        *          ),
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    Route::get('seed',function(){
        Artisan::call('db:seed');
        dd("Seeder Command run succssfly");
        });

});

