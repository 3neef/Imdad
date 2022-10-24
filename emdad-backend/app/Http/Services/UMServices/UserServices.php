<?php

namespace App\Http\Services\UMServices;

use App\Http\Controllers\Auth\MailController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UM\Role;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UMRequests\User\ActivateRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Models\UM\RoleUserCompany;

class UserServices
{

    public function create($request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'this route supported post method only'], 402);
        }
        $user = new User();
        $otp = rand(100000, 999999);
        $otp_expires_at = Carbon::now()->addMinutes(2);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->mobile = $request->get('mobile');
        $user->password = $request->get('password');
        $user->default_company = $request->get('defaultCompany');
        $user->otp = strval($otp);
        $user->otp_expires_at = $otp_expires_at;
        $user->forget_pass = 0;
        $result = $user->save();
        if ($result) {
            return response()->json([
                'message' => 'User created successfully',
                'data' => ['user' => new UserResponse($user)]
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
        $mobile = empty($request->get('mobile')) ? $user->value('mobile') : $request->get('mobile');
        $roleId = empty($request->get('roleId')) ? $user->value('role_id') : $request->get('roleId');
        $companyId = empty($request->get('companyId')) ? $user->value('company_id') : $request->get('companyId');
        $result = $user->update([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'role_id' => $roleId,
            'company_id' => $companyId
        ]);
        if ($result) {
            return response()->json([
                'message' => 'User updated successfully',
                'data'=> ['user' => new UserResponse($user)]
            ], 200);
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

        $password = ($request->get('password'));
            if ($user->password != $password) {
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
                    'data' => [
                        'user' => new UserResponse($user),
                        'token' => $token->plainTextToken
                    ]
                ]
            );

    }

    public function activate($request)
    {
        $id = ($request->get('id'));

        $user = User::where('id', '=', $id)->first();
        if ($user === null) {
            return response()->json(
                [
                    "message" => "We didn't recognize this id"
                ]
            );
        }

        $otp = ($request->get('otp'));
        $user = User::where('otp', '=', $otp)->first();
        if ($user === null) {
            return response()->json(
                [
                    "message" => "We didn't recognize this otp"
                ]
            );
        }
        $time_now = Carbon::now();
            if ($time_now > $user->otp_expires_at) {
                $otp = rand(100000, 999999);
                $otp_expires_at = Carbon::now()->addMinutes(1);
                $user->otp = $otp;
                $user->otp_expires_at = $otp_expires_at;
                $user->save();
                MailController::sendSignupEmail($user->name, $user->email, $user->otp);
                return response()->json(
                    [
                        "message" => "Your OTP has expired, New OTP has been sent!!"
                    ]
                );
            }else {
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->is_verified = 1;
                return response()->json(
                    [
                        'message' => 'Your account has been activated successfully.',
                        'data' => [
                            'user' => new UserResponse($user),
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
            'otp' => $otp,
            'otp_expires_at' => $otp_expires_at,
            'forget_pass' => 1
        ]);
        if ($result) {
            MailController::forgetPasswordEmail($user->name, $user->email, $user->otp);
            return response()->json([
                'message' => 'OTP has been created successfully',
                'OTP' => $otp,
                'otpExpiresAt' => $otp_expires_at
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function resetPassword($request)
    {
        $email = ($request->get('email'));
        $user = User::where('email', $email)->first();
        $new_password = ($request->get('newPassword'));
        if ($user === null) {
            return response()->json(
                [
                    "message" => "Unregistered email"
                ]
            );
        }
        if ($user->forget_pass == 1) {
            $pass_or_otp = $request->get('oldPassword');
            $user = User::where('otp', '=', $pass_or_otp)->first();
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
            'otp' => null,
            'otp_expires_at' => null
        ]);

        return response()->json(
            [
                "message" => "Password has been reset successfully!!"
            ]
        );
    }

    public function assignRole($request){
        $colmun = gettype($request ->json()->get( 'role' )) == 'integer' ? 'id' : 'name';
        $role = Role::where( $colmun, $request ->json()->get( 'role' ) )->first();
        $user = User::find($request->get('userId'));
        $companyId = $request->get('companyId');
        $userId = $request->get('userId');
        $user->roleInCompany()->attach($userId,['roles_id' =>$role->id,'company_info_id'=>$companyId]);
        return response()->json( [ 'message'=>'assign role successfully' ], 200 );
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
