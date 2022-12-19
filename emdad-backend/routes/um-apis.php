<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UsersProfilesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth.apikey'])->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [AuthController::class, 'store']);
    Route::put('verify-otp', [AuthController::class, 'activateUser']);
    Route::delete('remove-user/{id}', [AuthController::class, 'removeUser']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP']);
    Route::put("forgot-password", [AuthController::class, 'forgotPassword']);
    Route::post('logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');
    Route::put("reset-password", [AuthController::class, 'resetPassword'])->middleware('auth:sanctum');
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('users')->group(function () {
    Route::get('user-data', [UserController::class, 'getUserInfoByToken']);
    Route::get('index', [UserController::class, 'index']);

    Route::post('register', [UserController::class, 'store']);
    Route::put("Activate", [UserController::class, 'userActivate']);
    Route::put("disable", [UserController::class, 'disable']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::put("setDefaultCompany", [UserController::class, 'setDefaultCompany']);
    Route::delete('destroy/{id}', [UserController::class, 'delete']);
    Route::put("restore/{id}", [UserController::class, 'restoreUser']);
});


Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('permissions', PermissionsController::class);
    Route::put('permissions/restore/{permissionId}', [PermissionsController::class, 'restoreById']);
});

Route::middleware(['auth.apikey'])->group(function () {

    Route::put('roles/restore/{roleId}', [RoleController::class, 'restoreByRoleId']);
    Route::get('roles/roles-for-reg', [RoleController::class, 'getRolesForReg']);
});


Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('roles', RoleController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::get('usersProfiles', [UsersProfilesController::class, 'index']);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('department')->group(function () {
    Route::post('assing-User-To-Department', [DepartmentController::class, 'assingUser']);
});


Route::apiResource('department', DepartmentController::class)->middleware(['auth.apikey', 'auth:sanctum']);
