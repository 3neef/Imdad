<?php

use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group( function() {
});
Route::get('sendSms',[SmsController::class,'sendSms']);

