<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\User\CreateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UMRequests\User\ForgotPasswordRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\ResetPasswordRequest;
use App\Http\Services\UMServices\UserServices;

class AuthController extends Controller
{
    public function createUser(CreateUserRequest $request,UserServices $userServices)
    {
        return $userServices->create($request);
    }

    public function updateUser(GetUserRequest $request ,UserServices $userServices)
    {
        return $userServices->update($request);
    }

    public function loginUser(LoginRequest $request ,UserServices $userServices)
    {
        return $userServices->login($request);
    }


    public function logoutUser(GetUserRequest $request ,UserServices $userServices)
    {
        return $userServices->logout($request);
    }

    public function deleteUser(GetUserByIdRequest $request, $id, UserServices $userServices)
    {
        return $userServices->delete($id);
    }

    public function restoreUser(RestoreUserByIdRequest $request, $id,UserServices $userServices)
    {
        return $userServices->restoreById($id);
    }

    public function forgotPassword(ForgotPasswordRequest $request, UserServices $userServices)
    {
        return $userServices->forgotPassword($request);
    }

    public function resetPassword(ResetPasswordRequest $request, UserServices $userServices)
    {
        return $userServices->resetPassword($request);
    }


}