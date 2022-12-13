<?php

namespace App\Http\Services\UMServices;

use App\Http\Controllers\Auth\MailController;

use App\Models\User;
use App\Models\UM\Role;
use App\Models\UM\RoleUserCompany;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Models\UM\Permission;
use App\Models\UM\RoleUserProfile;

class UserServices
{

    public function create($request)
    {
        $request['first_name'] = $request['firstName'];
        $request['expiry_date'] = $request['expireDate'];
        $request['last_name'] = $request['lastName'];
        $request['identity_number'] = $request['identityNumber'];
        $request['identity_type'] = $request['identityType'];
        $request['full_name'] = $request['firstName'] . " " . $request['lastName'];
        $request['otp_expires_at'] = now()->addMinutes(5);
        $request['is_super_admin'] = true;
        // dd($request);

        $request['otp'] = strval(rand(1000, 9999));
        $user = User::create($request);
        $role_id = $request['roleId']??'';
        if ($role_id){
            $user->roleInProfile()->attach($user->id, ['roles_id' => $request['roleId'], 'profile_id' => auth()->user()->profile_id]);

            $user->update(['profile_id' => auth()->user()->profile_id]);
        }

        if ($user) {
            return response()->json([
                'message' => 'User created successfully',
                'data' => ['user' => new UserResponse($user)]
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }





    public function update($request)
    {
        $user = User::where('id', auth()->id())->first();
        $user->update([
            'first_name' => $request->firstName ?? $user->first_name,
            "last_name" => $request->lastName ?? $user->last_name,
            "full_name" => $request->firstName . " " . $request->lastName ?? $user->full_name,
            "email" => $request->email ?? $user->email,
            "mobile" => $request->mobile ?? $user->mobile,
        ]);

        $userRoleProfile= RoleUserProfile::where('user_id', $user->id)->where('profile_id', $user->profile_id)->first();

        if ($request->has("roleId") && $userRoleProfile != null) {

            $userRoleProfile->update(['user_id' => $user->id, 'role_id' => $request['roleId'], 'profile_id' => auth()->user()->profile_id]);
        }

        if ($user) {
            return response()->json([
                'message' => 'User updated successfully',
                'data' => ['user' => $user]
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function login(LoginRequest $request)
    {

        $user = User::where('email', '=', $request->email)
            ->orwhere('mobile', $request->mobile)
            ->first();

        if (isset($request->mobile)) {
            $user = User::where('mobile', '=', $request->mobile)->first();

            $data = $this->sendOtp($user);
            return response()->json(
                [
                    "success" => false, "error" => "verifiy your otp first",
                    "data" => $data
                ]
            );
        }


        if ($user->is_verified == 0) {
            return response()->json(
                [
                    "success" => false, "error" => "verifiy your otp first"
                ]
            );
        }
        if (!($user->password === $request->password)) {
            return response()->json(
                [
                    "success" => false, "error" => "Wrong credentials"
                ]
            );
        }
        $token = $user->createToken('authtoken', json_decode($user->permissions, true) ??[""]);

        return response()->json(
            [
                'message' => 'Logged in',
                'data' => [
                    'user' => $user,
                    'token' => $token->plainTextToken
                ]
            ]
        );
    }

    public function activate($request)
    {

        $user = User::where('id', '=', $request->id)->first();
        if ($request->otp != $user->otp) {
            return response()->json(
                [
                    "success" => false, "error" => "Invalid OTP"
                ]
            );
        } elseif ($user->otp_expires_at < now()) {
            return response()->json(
                [
                    "success" => false, "error" => "Expired OTP"
                ]
            );
        }

        $user->update(['is_verified' => true]);
        $token = $user->createToken('authtoken');
        return response()->json(
            [
                'message' => 'Your account has been activated successfully.',
                'token' => $token->plainTextToken,
            ]
        );
    }

    public function resend($request)
    {
        $user = isset($request->mobile) ? User::where('mobile', '=', $request->mobile)->first() : User::where('email', '=', $request->email)->first();
        $otp = rand(1000, 9999);
        $user->update(['otp' => strval($otp), 'otp_expires_at' => now()->addMinutes(5)]);
        // MailController::sendSignupEmail($user->name, $user->email, $user->otp);
        // $smsService->sendOtp($user->name, $user->mobile, $user->otp);
        return response()->json(
            [
                'message' => 'New OTP has been sent.',
                'otp' => $user->otp,
            ]
        );
    }

    public function logout()
    {
        $user = auth()->user()->tokens()->delete();
        session()->invalidate();

        return response()->json(
            [
                'message' => 'Logged out', 'user' => $user
            ]
        );
    }

    public function delete($id)
    {

        $user = User::find($id)->first();
        if($user==null)
        {
        return response()->json(['error' => 'user already deleted'], 403);
            
        }
        // dd($user);

        $user->tokens()->delete();

        $deleted = $user->delete();

        if ($deleted) {
            return response()->json(['message' => 'User deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function restoreById($request)
    {
        $restore = User::where('id', $request->id)->withTrashed()->first()->restore();

        if ($restore) {
            return response()->json(['message' => 'User restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function forgotPassword($request)
    {
        $otp = rand(1000, 9999);
        $otp_expires_at = now()->addMinutes(2);
        $user = User::where('email', $request->email)->first();
        if ($user === null) {
            return response()->json(
                [
                    "success" => false, "error" => "Unregistered email"
                ]
            );
        }
        $result = $user->update([
            'otp' => $otp,
            'otp_expires_at' => $otp_expires_at,
        ]);
        if ($result) {
            MailController::forgetPasswordEmail($user->full_name, $user->email, $user->otp);
            return response()->json([
                'message' => 'OTP has been created successfully',
                'OTP' => $otp,
                'otpExpiresAt' => $otp_expires_at
            ], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    // Todo  Need Code Again !
    public function resetPassword($request)
    {

    }

    public function assignRole($request)
    {
        $colmun = gettype($request->json()->get('role')) == 'integer' ? 'id' : 'name';
        $role = Role::where($colmun, $request->json()->get('role'))->first();
        $user = User::find($request->get('userId'));
        $companyId = $request->get('companyId');
        $userId = $request->get('userId');
        $user->roleInCompany()->attach($userId, ['roles_id' => $role->id, 'company_info_id' => $companyId]);
        return response()->json(['message' => 'assign role successfully'], 200);
    }

    public function unAssignRole($request)
    {
        $userRoleCompany = RoleUserProfile::where('user_id', '=', $request->userId)->where('profile_id', '=', $request->profile_id)->first();
        $deleted = $userRoleCompany->delete();
        if ($deleted) {
            return response()->json(['message' => 'unassign role successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restoreOldRole($request)
    {
        $userRoleCompany = RoleUserProfile::where('user_id', '=', $request->userId)->where('profile_id', '=', $request->profile_id)->withTrashed()->first()->restore();
        if ($userRoleCompany) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function setDefaultCompany($request)
    {

        $user = User::where("id",auth()->id())->first();
        $user->update(
            [
                "profile_id"=>$request->profileId
            ]
            );

            return response()->json([
                'message' => 'Default company successfully',
                'data' => ['user' => new UserResponse($user)]
            ], 200);

    }

    public function showAll()
    {
        #code...
    }

    public function showById($id)
    {
        #code...
    }

    public function removeUser($id)
    {
        $user = User::find($id);

        $user->tokens()->delete();

        $user->forceDelete();
        if ($user) {
            return response()->json(['message' => 'User delete form database successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
    protected function getAbilities()
    {
        $role_id = RoleUserProfile::where('user_id', auth()->id())->where('profile_id', auth()->user()->profile_id)->first();
        $permissions = Permission::where('role_id', $role_id)->get();
        return $permissions;
    }

    protected  function sendOtp($user)
    {
        $otp = rand(1000, 9999);
        $user->update(['otp' => strval($otp), 'otp_expires_at' => now()->addMinutes(5), 'is_verified' => 0]);
        // MailController::sendSignupEmail($user->name, $user->email, $user->otp);
        // $smsService->sendOtp($user->name, $user->mobile, $user->otp);
        return response()->json(
            [
                'message' => 'New OTP has been sent.',
                'otp' => $user->otp,
            ]
        );
    }

}
