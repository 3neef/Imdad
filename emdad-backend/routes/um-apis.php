<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\UMController\DepartmentController;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'loginUser'])->middleware('app_auth');


Route::middleware('app_auth','auth:sanctum')->group(['prefix' => 'users'], function() {
    Route::post('register', [AuthController::class, 'createUser'])->middleware("app_auth");
    Route::post('createUser', [AuthController::class, 'createUserToCompany']);
    Route::post('activate', [AuthController::class, 'activateUser']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP'])->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum','app_auth');
    Route::put("update", [AuthController::class, 'updateUser']);
    Route::delete("delete/{id}", [AuthController::class, 'deleteUser']);
    Route::put("restore/{id}", [AuthController::class, 'restoreUser']);
    Route::put("forgot-password", [AuthController::class, 'forgotPassword']);
    Route::put("reset-password", [AuthController::class, 'resetPassword']);
    Route::post("assginRole", [AuthController::class, 'assignRole']);
    Route::post("unAssginRole", [AuthController::class, 'unAssignRole']);
    Route::post("oldRole", [AuthController::class, 'restoreOldRole']);
    Route::put("setDefaultCompany", [AuthController::class, 'setDefaultCompany']);
});


Route::middleware('app_auth','auth:sanctum')->group(['prefix' => 'permissions'], function() {
    Route::post('save',[PermissionsController::class,'savePermission']);
    Route::get('getAll',[PermissionsController::class,'getAllPermissions']);
    Route::get('getById/{id}',[PermissionsController::class,'getPermissionByRoleId']);
    Route::put('update',[PermissionsController::class,'updatePermission']);
    Route::delete('delete/{id}',[PermissionsController::class,'deletePermission']);
    Route::put('restore/{id}',[PermissionsController::class,'restoreById']);
});

Route::middleware('app_auth','auth:sanctum')->group(['prefix' => 'roles'], function() {
    Route::post('save',[RoleController::class,'saveRole']);
    Route::get('getAll',[RoleController::class,'getAllRoles']);
    Route::get('getByRoleId/{id}',[RoleController::class,'getByRoleId']);
    Route::get('getByType/{type}',[RoleController::class,'getByType']);
    Route::put('update',[RoleController::class,'updateRole']);
    Route::delete('delete/{id}',[RoleController::class,'deleteRole']);
    Route::put('restore/{id}',[RoleController::class,'restoreByRoleId']);
    Route::get('roles-for-reg',[RoleController::class,'getRolesForReg']);

});

Route::middleware('app_auth','auth:sanctum')->group(['prefix'=>'department'],function(){
    Route::post('create',[DepartmentController::class,'create']);

});
