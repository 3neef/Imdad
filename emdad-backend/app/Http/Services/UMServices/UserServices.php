<?php

namespace App\Http\Services\UMServices;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class UserServices
{

    public function create($request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'this route supported post method only'], 402);
        }
        $user = new User();
        $user->name = $request->get('name');
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $result = $user->save();
        $token = $user->createToken('authtoken');
        if ($result) {
            return response()->json([
                'message' => 'User created successfully',
                'data' => ['token' => $token->plainTextToken, 'user' => $user]
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function update($request)
    {
        if (!$request->isMethod('put')) {
            return response()->json(['error' => 'this route supported put method only'], 402);
        }
        $user = User::find($request->get('id'));
        $name = empty($request->get('name')) ? $user->value('name') : $request->get('name');
        $email = empty($request->get('email')) ? $user->value('email') : $request->get('email');
        $result = $user->update([
            'name' => $name,
            'email' => $email,
            'role_id' => $request->get('role_id'),
            'type' => $request->get('type')
        ]);
        if ($result) {
            return response()->json(['message' => 'User updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $token = $request->user()->createToken('authtoken');
        return response()->json(
            [
                'message' => 'Logged in',
                'data' => [
                    'user' => $request->user(),
                    'token' => $token->plainTextToken
                ]
            ]
        );
    }

    public function logout($request)
    {
        $request->user()->tokens()->delete();
        session()->invalidate();

        return response()->json(
            [
                'message' => 'Logged out'
            ]
        );
    }

    public function delete($id)
    {
        $user = User::find($id);
        $deleted = $user->delete();
        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restoreById($id)
    {
        $restore = User::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'User restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function forgotPassword($request)
    {   
        $otp = rand(100000,999999);
        $email = ($request->get('email'));
        $user = User::where('email', $email);
        $result = $user->update(['login_otp' => $otp]);
        if ($result) {
            return response()->json(['message' => 'OTP has been created successfully', 'OTP' => $otp], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function showAll()
    {
        #code...
    }

    public function showById($id)
    {
        #code...
    }
}
