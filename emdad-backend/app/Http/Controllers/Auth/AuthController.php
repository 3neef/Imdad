<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();


        $token = $request->user()->createToken('authtoken');

       return response()->json(
           [
               'message'=>'Logged in',
               'data'=> [
                   'user'=> $request->user(),
                   'token'=> $token->plainTextToken
               ]
           ]
        );
    }


    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Registered',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );

    }


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        session()->invalidate();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->role_id = $request->role_id;

        $user->save();
        return response()->json($user);
    }


}