<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMController\DepartmentController;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;
use App\Http\Controllers\User\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['app.auth'])->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [UserController::class, 'store']);
    Route::put('verifiy-otp', [AuthController::class, 'activapteUser']);
    Route::delete('remove-user/{id}', [AuthController::class, 'removeUser']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP']);
    Route::put("forgot-password", [AuthController::class, 'forgotPassword']);
    Route::post('logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');
    Route::put("reset-password", [AuthController::class, 'resetPassword'])->middleware('auth:sanctum');
});

Route::middleware(['app.auth'])->prefix('roles')->group(function () {
    Route::get('getAll', [RoleController::class, 'getAllRoles']);
});

Route::middleware(['app.auth', 'auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class)->only(['update','destroy']);
});

Route::middleware(['app.auth', 'auth:sanctum'])->prefix('users')->group(function () {
    Route::put("setDefaultCompany", [UserController::class, 'setDefaultCompany']);
    Route::put("restore/{id}", [UserController::class, 'restoreUser']);
    Route::get('user-data', [UserController::class, 'getUserInfoByToken']);
    Route::post("Activate", [UserController::class, 'Activate']);
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
    Route::post('assing-User-To-Department', [DepartmentController::class, 'assingUser']);
});
