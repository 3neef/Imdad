<?php

namespace App\Http\Services\UMServices;

use App\Http\Controllers\Auth\MailController;

use App\Models\User;
use App\Models\UM\Role;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\AccountServices\PackageConstraint;
use App\Http\Services\General\SmsService;
use App\Models\Accounts\Warehouse;
use App\Models\UM\Permission;
use App\Models\UM\RoleUserProfile;
use App\Models\UserWarehousePivot;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;



class UserServices
{

    public function create($request)
    {
        $packageLimit = new PackageConstraint;
        $value = User::where('profile_id', auth()->user()->profile_id)->count();
        $Limit = $packageLimit->packageLimitExceed("user", $value);
        if ($Limit == false) {
            return response()->json([
                "statusCode" => "360",
                'success' => false,
                 'message' => "You have exceeded the allowed number of users to create it"
            ], 200);
        }

        $user = DB::transaction(function () use ($request) {
            $request['full_name'] = $request['fullName'];
            $request['expiry_date'] = $request['expireDate'] ?? null;
            $request['identity_number'] = $request['identityNumber'] ?? "";
            $request['identity_type'] = $request['identityType'] ?? 'nid';
            $request['otp_expires_at'] = now()->addMinutes(5);
            $request['is_super_admin'] = true;

            $user = User::create($request);
            $this->UserOtp($user);
            $role_id = $request['roleId'] ?? null;
            $is_learning = $request['is_learning'] ?? false;
            $manager_id = null;
            if (isset($request['managerUserId'])) {
                $manager_id = $request['managerUserId'];
            } else {
                $manager_id = auth()->id() ?? null;
            }
            if ($role_id && $manager_id) {
                $user->roleInProfile()->attach($user->id, ['user_id' => $user->id, 'role_id' => $role_id, "created_by" => auth()->id(), 'profile_id' => auth()->user()->profile_id, 'is_learning' => $is_learning, 'status' => $request['status'], 'manager_user_Id' => $manager_id]);

                $user->update(['profile_id' => auth()->user()->profile_id]);
            }
            if (isset($request->warahouseId)) {

                $user->warehouse()->attach($user->id, ['warehouse_id' => $request->warahouseId,]);
            }
            return $user;
        });
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'User created successfully',
                'data' => ['user' => new UserResponse($user)]
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'success' => false, 'message' => "System Error"
        ], 200);
    }





    //to do 
    public function UpdateOwnerUser($request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $user->checkUserRole($user_id);

        if ($user == true) {
            return response()->json([
                "statusCode" => "999",

                'message' => 'cano,t  updated User'
            ], 200);
        }
        $this->update($request, $user_id);
    }

    public function update($request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            "full_name" => $request->fullName ?? $user->full_name,
            "email" => $request->email ?? $user->email,
            "mobile" => $request->mobile ?? $user->mobile,
            "identity_number" => $request->identityNumber ?? $user->identity_number,
            'expiry_date' => $request['expireDate'] ?? $user->expiry_date,
            'lang' =>  $request['lang'] ?? $user->lang,

        ]);

        $WarahouseId = $request->warahouseId ?? null;
        if ($WarahouseId != null) {
            try {
                $user->warehouse()->attach(
                    $user->id,
                    [
                        'warehouse_id' => $request->warahouseId,
                    ]
                );
            } catch (Exception $ex) {
            }
        }


        $userRoleProfile = RoleUserProfile::where('user_id', $user->id)->where('profile_id', $user->profile_id)->first();

        if ($request->has("roleId") && $userRoleProfile != null) {

            $userRoleProfile->update(['user_id' => $user->id ?? $userRoleProfile->user_id, 'role_id' => $request['roleId'] ?? $userRoleProfile->role_id, 'profile_id' => auth()->user()->profile_id, 'status' => $request['status']??$userRoleProfile->status, "manger_user_id" => $request['mangerUserId'] ?? $userRoleProfile->manger_user_id]);
        }
        if ($user->wasChanged('mobile')) {
            $user->update(['is_verified' => 0]);
            $this->UserOtp($user);
            return response()->json(
                [
                    "statusCode" => "000",

                    'message' => 'New OTP has been sent.',
                    'otp' => $user->otp,
                ],
                200
            );
        }
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'User updated successfully',
                'data' => ['user' => new UserResponse($user)]
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }

    public function detachWarehouse($request)
    {
    UserWarehousePivot::where("user_id",$request->userId)->where("warehouse_id",$request->warehouseId)->first()->forceDelete();
        return response()->json([
            "statusCode" => "000",

            'message' => 'User deatched successfully'
        ], 200);
    }
    public function userWarehouseStatus($request)
    {
        $userWarehouse = UserWarehousePivot::where("user_id", $request->userId)->where("warehouse_id", $request->warehouseId)->first();
        if ($userWarehouse != null) {
            $userWarehouse->update(['status' => $request->status]);
            return response()->json([
                "statusCode" => "000",

                'message' => 'status update successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }



    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->orwhere('mobile', $request->mobile)->first();

        if (isset($request->mobile)) {
            $user = User::where('mobile', '=', $request->mobile)->first();

            $data = $this->UserOtp($user);
            return response()->json(
                [
                    "statusCode" => "105",

                    "success" => true, "message" => "verifiy your otp first",
                ],
                200
            );
        }

        if (!($user->password === $request->password)) {
            return response()->json(
                [
                    "statusCode" => "104",

                    "success" => false, "error" => "Wrong credentials"
                ],
                200
            );
        }

        if ($user->is_verified == 0) {
            $data = $this->UserOtp($user);

            return response()->json(
                [
                    "statusCode" => "105",

                    "success" => false, "error" => "Forbidden"
                ],
                200
            );
        }
        $token = $user->createToken('authtoken');

        return response()->json(
            [
                "statusCode" => "000",

                'message' => 'Logged in',
                'data' => [
                    'user' => new UserResponse($user),
                    'token' => $token->plainTextToken
                ], 200
            ]
        );
    }

    public function activate($request)
    {

        $user = User::where('id', $request->id)->orWhere('mobile', $request->mobile)->first();
        if ($request->otp != $user->otp) {
            return response()->json(
                [
                    "statusCode" => "101",

                    "success" => false, "error" => "Invalid OTP"
                ],
                200
            );
        } elseif ($user->otp_expires_at < now()) {
            return response()->json(
                [
                    "statusCode" => "102",

                    "success" => false, "error" => "Expired OTP"
                ],
                200
            );
        } elseif ($user->is_verified == true) {
            return response()->json(
                [
                    "statusCode" => "103",

                    "success" => false, "error" => "Your Account Already Activated"
                ],
                200
            );
        }

        $user->update(['is_verified' => true]);
        $token = $user->createToken('authtoken');
        return response()->json(
            [
                "statusCode" => "000",

                'message' => 'Your account has been activated successfully.',
                'token' => $token->plainTextToken,
                "user" => new UserResponse($user),
            ],

            200
        );
    }

    public function resend($request)
    {
        $user = isset($request->mobile) ? User::where('mobile', '=', $request->mobile)->first() : User::where('email', '=', $request->email)->first();
             $this->UserOtp($user);
        MailController::sendSignupEmail($user->name, $user->email, $user->otp);
        return response()->json(
            [
                "statusCode" => "000",
                'message' => 'New OTP has been sent.',
            ],
            200
        );
    }

    public function logout()
    {
        $user = auth()->user()->tokens()->delete();
        session()->invalidate();

        return response()->json(
            [
                "statusCode" => "000",

                'message' => 'Logged out', 'user' => $user
            ],
            200
        );
    }

    public function delete($id)
    {

        $user = User::find($id)->first();
        if ($user == null) {
            return response()->json([
                "statusCode" => "000",
                'error' => 'user already deleted'
            ], 200);
        }
        // dd($user);

        $user->tokens()->delete();

        $deleted = $user->delete();

        if ($deleted) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'User deleted successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",
            'error' => 'system error'
        ], 200);
    }


    public function restoreById($request)
    {
        $restore = User::where('id', $request->id)->withTrashed()->first()->restore();

        if ($restore) {
            return response()->json(['message' => 'User restored successfully'], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }


  

    // Todo  Need Code Again !
    public function resetPassword($request)
    {
        $user = User::where('email', $request->email)->first();

        $user->update(['password' => $request->password]);

        event(new PasswordReset($user));
        if ($user) {
            return response()->json([
                "statusCode" => "000",

                "success" => true,
                'message' => 'password Reste successfly',
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            "success" => false,
            'message' => 'system Error',
        ], 200);
    }

    public function assignRole($request)
    {
        $colmun = gettype($request->json()->get('role')) == 'integer' ? 'id' : 'name';
        $role = Role::where($colmun, $request->json()->get('role'))->first();
        $user = User::find($request->get('userId'));
        $companyId = $request->get('companyId');
        $userId = $request->get('userId');
        $user->roleInCompany()->attach($userId, ['roles_id' => $role->id, 'company_info_id' => $companyId]);
        return response()->json([
            "statusCode" => "000",

            'message' => 'assign role successfully'
        ], 200);
    }

    public function userActivate($request)
    {
        $user = User::where('id', $request->userId)->first();
        $userRoleProfile = RoleUserProfile::where('profile_id', $user->profile_id)->first();

        if ($userRoleProfile == null) {
            return response()->json([
                "statusCode" => "263",

                'error' => 'user doesn\'t belong to this company'
            ], 200);
        }
        $active = $userRoleProfile->update(['status' => 'active']);
        if ($active) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'user account has activated successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }


    public function disable($request)
    {
        $user = User::where('id', $request->userId)->first();
        $userRoleProfile = RoleUserProfile::where('profile_id', $user->profile_id)->first();
        $active = $userRoleProfile->update(['status' => 'inActive']);
        // dd($userRoleProfile);
        if ($active) {
            return response()->json([
                "statusCode" => "000",

                'message' => 'user account has disabled successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }

    public function restoreOldRole($request)
    {
        $userRoleCompany = RoleUserProfile::where('user_id', $request->userId)->where('profile_id', $request->profile_id)->withTrashed()->first()->restore();
        if ($userRoleCompany) {
            return response()->json([
                "statusCode" => "000",
                'message' => 'restored successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",

            'error' => 'system error'
        ], 200);
    }

    public function setDefaultCompany($request)
    {

        $user = User::where("id", auth()->id())->first();
        $user->update(
            [
                "profile_id" => $request->profileId
            ]
        );

        return response()->json([
            "statusCode" => "000",

            'message' => 'Default company successfully',
            'data' => ['user' => new UserResponse($user)]
        ], 200);
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
            return response()->json([
                "statusCode" => "000",

                'message' => 'User delete form database successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => "999",
            'error' => 'system error'
        ], 200);
    }
    protected function getAbilities()
    {
        $role_id = RoleUserProfile::where('user_id', auth()->id())->where('profile_id', auth()->user()->profile_id)->first();
        $permissions = Permission::where('role_id', $role_id)->get();
        return $permissions;
    }

    protected  function UserOtp($user)
    {

        $smsService = new SmsService;

        $otp = rand(1000, 9999);

        $user->update(['otp' => strval($otp), 'otp_expires_at' => now()->addMinutes(5), 'is_verified' => 0]);
        
        MailController::sendSignupEmail($user->name, $user->email, $user->otp, $user->lang);

        $smsService->sendSms($user->mobile, $user->password, 'password');    

    }
}
