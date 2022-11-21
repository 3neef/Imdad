<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMController\DepartmentController;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['app.auth'])->prefix('users')->group(function () {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [AuthController::class, 'createUser']);
    Route::put('activate', [AuthController::class, 'activateUser']);
    Route::delete("delete/{id}", [AuthController::class, 'deleteUser']);


});
Route::middleware(['app.auth'])->prefix('roles')->group(function () {
    Route::get('getAll', [RoleController::class, 'getAllRoles']);
});

Route::middleware(['app.auth', 'auth:sanctum'])->prefix('users')->group(function () {

    Route::post('createUser', [AuthController::class, 'createUserToCompany']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP']);
    Route::post('logout', [AuthController::class, 'logoutUser']);
    Route::put("update", [AuthController::class, 'updateUser']);
    Route::put("restore/{id}", [AuthController::class, 'restoreUser']);
    Route::put("forgot-password", [AuthController::class, 'forgotPassword']);
    Route::put("reset-password", [AuthController::class, 'resetPassword']);
    Route::post("assginRole", [AuthController::class, 'assignRole']);
    Route::post("unAssginRole", [AuthController::class, 'unAssignRole']);
    Route::post("oldRole", [AuthController::class, 'restoreOldRole']);
    Route::put("setDefaultCompany", [AuthController::class, 'setDefaultCompany']);
});


Route::middleware(['app.auth', 'auth:sanctum'])->prefix('permissions')->group(function () {

    Route::post('save', [PermissionsController::class, 'savePermission']);
    Route::get('getAll', [PermissionsController::class, 'getAllPermissions']);
    Route::get('getById/{id}', [PermissionsController::class, 'getPermissionByRoleId']);
    Route::put('update', [PermissionsController::class, 'updatePermission']);
    Route::delete('delete/{id}', [PermissionsController::class, 'deletePermission']);
    Route::put('restore/{id}', [PermissionsController::class, 'restoreById']);
});

Route::middleware(['app.auth', 'auth:sanctum'])->prefix('roles')->group(function () {

    Route::post('save', [RoleController::class, 'saveRole']);
    Route::get('getByRoleId/{id}', [RoleController::class, 'getByRoleId']);
    Route::get('getByType/{type}', [RoleController::class, 'getByType']);
    Route::put('update', [RoleController::class, 'updateRole']);
    Route::delete('delete/{id}', [RoleController::class, 'deleteRole']);
    Route::put('restore/{id}', [RoleController::class, 'restoreByRoleId']);
    Route::get('roles-for-reg', [RoleController::class, 'getRolesForReg']);
});

// Route::middleware('app.auth','auth:sanctum')->group(['prefix'=>'department'],function(){
Route::middleware(['app.auth', 'auth:sanctum'])->prefix('department')->group(function () {
    Route::post('create', [DepartmentController::class, 'create']);
});
