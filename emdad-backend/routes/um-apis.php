<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function() {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');
    Route::put("update", [AuthController::class, 'updateUser']);
    Route::delete("delete/{id}", [AuthController::class, 'deleteUser']);
    Route::put("restore/{id}", [AuthController::class, 'restoreUser']);
    Route::put("forgot-password", [AuthController::class, 'forgotPassword']);
    Route::put("reset-password", [AuthController::class, 'resetPassword']);
});

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
