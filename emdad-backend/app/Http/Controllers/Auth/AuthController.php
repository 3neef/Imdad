<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\User\CreateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\GetUserRequest;
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


    // public function register(CreateUserRequest $request)
    // {

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'type' => $request->type,
    //     ]);

    //     $token = $user->createToken('authtoken');

    //     return response()->json(
    //         [
    //             'message'=>'User Registered',
    //             'data'=> ['token' => $token->plainTextToken, 'user' => $user]
    //         ]
    //     );

    // }


    // public function logout(Request $request)
    // {

    //     $request->user()->tokens()->delete();
    //     session()->invalidate();

    //     return response()->json(
    //         [
    //             'message' => 'Logged out'
    //         ]
    //     );

    // }

    // public function update(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->type = $request->type;
    //     $user->role_id = $request->role_id;

    //     $user->save();
    //     return response()->json($user);
    // }


}