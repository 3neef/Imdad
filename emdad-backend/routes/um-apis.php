<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\emdad\UMController\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\UMController\PermissionsController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');


Route::group(['prefix' => 'permissions'], function() {
    Route::post('save',[PermissionsController::class,'savePermission']);
    Route::get('getAll',[PermissionsController::class,'getAllPermissions']);
    Route::get('getById/{id}',[PermissionsController::class,'getPermissionByRoleId']);
    Route::put('update',[PermissionsController::class,'updatePermission']);
    Route::delete('delete/{id}',[PermissionsController::class,'deletePermission']);
    Route::put('restore/{id}',[PermissionsController::class,'restoreById']);
});

Route::group(['prefix' => 'roles'], function() {
    Route::post('save',[RoleController::class,'saveRole']);
    Route::get('getAll',[RoleController::class,'getAllRoles']);
    Route::get('getByRoleId/{id}',[RoleController::class,'getByRoleId']);
    Route::put('update',[RoleController::class,'updateRole']);
    Route::delete('delete/{id}',[RoleController::class,'deleteRole']);
    Route::put('restore/{id}',[RoleController::class,'restoreByRoleId']);
});
