<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UMRequests\User\ActivateRequest;
use App\Http\Services\UMServices\UserServices;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\CreateUserRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\ResetPasswordRequest;
use App\Http\Requests\UMRequests\User\ForgotPasswordRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;

class AuthController extends Controller
{
    public function createUser(CreateUserRequest $request,UserServices $userServices)
    {
        return $userServices->create($request);
    }

    public function createUserToCompany(CreateUserRequest $request,UserServices $userServices)
    {
        return $userServices->createUserToCompany($request);
    }

    public function updateUser(UpdateRequest $request ,UserServices $userServices)
    {
        return $userServices->update($request);
    }


       /**
        * @OA\Post(
        * path="/api/v1_0/users/login",
        * operationId="authLogin",
        * tags={"UM"},
        * summary="User Login",
        * description="Login User Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"email","password"},
        *               @OA\Property(property="email", type="email"),
        *               @OA\Property(property="password", type="password")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

    public function loginUser(LoginRequest $request ,UserServices $userServices)
    {
        return $userServices->login($request);
    }


       /**
        * @OA\Put(
        * path="/api/v1_0/users/activate",
        * operationId="user-activation",
        * tags={"UM"},
        * summary="User Activation",
        * description="activate by otp",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="application-json",
        *            @OA\Schema(
        *               type="object",
        *               required={"id", "otp"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="otp", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="Login Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

    public function activateUser(ActivateRequest $request ,UserServices $userServices)
    {
        return $userServices->activate($request);
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

    public function assignRole(AssignRoleRequest $request,UserServices $userServices)
    {
        return $userServices->assignRole($request);
    }

    public function unAssignRole(AssignRoleRequest $request,UserServices $userServices)
    {
        return $userServices->unAssignRole($request);
    }

    public function restoreOldRole(AssignRoleRequest $request,UserServices $userServices)
    {
        return $userServices->restoreOldRole($request);
    }

    public function setDefaultCompany(DefaultCompanyRequest $request,UserServices $userServices)
    {
        return $userServices->setDefaultCompany($request);
    }


}
