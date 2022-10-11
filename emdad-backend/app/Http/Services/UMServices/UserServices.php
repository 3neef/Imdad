<?php

namespace App\Http\Services\UMServices;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;


class UserServices
{

    public function create($request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'this route supported post method only'], 402);
        }
        $user = new User();
        $otp = rand(100000, 999999);
        $otp_expires_at = Carbon::now()->addMinutes(1);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->type = $request->get('type');
        $user->login_otp = strval($otp);
        $user->otp_expires_at = $otp_expires_at;
        $user->forget_pass = 1;
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

        $email = ($request->get('email'));

        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            return response()->json(
                [
                    "message" => "We didn't recognize this email"
                ]
            );
        }

        if ($user->forget_pass === 1) {
            $pass_or_otp = ($request->get('password'));
            $user = User::where('login_otp', '=', $pass_or_otp)->first();
            if ($user === null) { //not otp
                $user = User::where('password', '=', $pass_or_otp)->first();
                if ($user === null) { // not password
                    return response()->json(
                        [
                            "message" => "We didn't recognize this password"
                        ]
                    );
                }
                $token = $user->createToken('authtoken');
                return response()->json(
                    [
                        'message' => 'Logged in',
                        'pass_type' => 'Password',
                        'redirect_to' => 'Reset password',
                        'data' => [
                            'user' => $user,
                            'token' => $token->plainTextToken
                        ]
                    ]
                );
            }

            $time_now = Carbon::now();
            if ($time_now > $user->otp_expires_at) {
                $otp = rand(100000, 999999);
                $otp_expires_at = Carbon::now()->addMinutes(1);
                $user->login_otp = $otp;
                $user->otp_expires_at = $otp_expires_at;
                $user->save();
                return response()->json(
                    [
                        "message" => "Your OTP has expired, New OTP has been sent!!"
                    ]
                );
            } else {
                $token = $user->createToken('authtoken');
                return response()->json(
                    [
                        'message' => 'Logged in',
                        'pass_type' => 'otp',
                        'redirect_to' => 'Reset password',
                        'data' => [
                            'user' => $user,
                            'token' => $token->plainTextToken
                        ]
                    ]
                );
            }
        } else {
            $password = ($request->get('password'));
            $user = User::where('password', '=', $password)->first();
            if ($user === null) {
                return response()->json(
                    [
                        "message" => "We didn't recognize this password"
                    ]
                );
            }
            $token = $user->createToken('authtoken');
            return response()->json(
                [
                    'message' => 'Logged in',
                    'pass_type' => 'Password',
                    'data' => [
                        'user' => $user,
                        'token' => $token->plainTextToken
                    ]
                ]
            );
        }
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
        $otp = rand(100000, 999999);
        $otp_expires_at = Carbon::now()->addMinutes(1);
        $email = ($request->get('email'));
        $user = User::where('email', $email)->first();
        if ($user === null) {
            return response()->json(
                [
                    "message" => "Unregistered email"
                ]
            );
        }
        $result = $user->update([
            'login_otp' => $otp,
            'otp_expires_at' => $otp_expires_at,
            'forget_pass' => 1
        ]);
        if ($result) {
            return response()->json([
                'message' => 'OTP has been created successfully',
                'OTP' => $otp,
                'otp_expires_at' => $otp_expires_at
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function resetPassword($request)
    {
        $email = ($request->get('email'));
        $user = User::where('email', $email)->first();
        $new_password = ($request->get('new_password'));
        if ($user === null) {
            return response()->json(
                [
                    "message" => "Unregistered email"
                ]
            );
        }
        if ($user->forget_pass == 1) {
            $pass_or_otp = $request->get('old_password');
            $user = User::where('login_otp', '=', $pass_or_otp)->first();
            if ($user === null) { //not otp
                $user = User::where('password', '=', $pass_or_otp)->first();
                if ($user === null) { // not password
                    return response()->json(
                        [
                            "message" => "We didn't recognize this password"
                        ]
                    );
                }
            }
        }
        $user->update([
            'password' => $new_password,
            'forget_pass' => 0,
            'login_otp' => null,
            'otp_expires_at' => null
        ]);

        return response()->json(
            [
                "message" => "Password has been reset successfully!!"
            ]
        );
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
