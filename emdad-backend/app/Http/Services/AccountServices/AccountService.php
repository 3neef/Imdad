<?php

namespace App\Http\Services\AccountServices;


use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Http\Services\General\WalletsService;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Profile;
use App\Models\SubscriptionPayment;
use App\Models\UM\Permission;
use App\Models\UM\RoleUserProfile;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Str;

class AccountService
{
    public function store($request)
    {
        try {

            $profile = DB::transaction(function () use ($request) {

                $company = RelatedCompanies::where("cr_number", $request->crNo)->first();
                $user = User::where('id', auth()->user()->id)->first();
                // dd($user->profiles);
                $profile = Profile::create([
                    "type" => $request->ProfileType,
                    "name_ar" => $company->cr_name,
                    "cr_number" => $company->cr_number,
                    "created_by" => auth()->user()->id,
                    "is_validated" => true,
                    "active" => 1,
                ]);
                 WalletsService::create($profile);
                $permissions = $this->pluckPermissions($request->ProfileType);
                // $user->roleInProfile()->attach($user->id, ['user_id' => $user->id, 'role_id' =>  $request['roleId'], "created_by" => auth()->id(), 'profile_id' => $profile->id, 'is_learning' => 0, 'status' => 'active', 'manager_user_Id' => auth()->user()->id,'permissions' => $permissions]);
                // 
                $user->profiles()->attach($user->id, ['user_id' => $user->id, 'role_id' =>  $request['roleId'], "created_by" => auth()->id(), 'profile_id' => $profile->id, 'is_learning' => 0, 'status' => 'active', 'manager_user_Id' => auth()->user()->id,'permissions' => $permissions]);


                $user=User::where("id",auth()->user()->id)->first();
                $user->update(['profile_id' => $profile->id]);

                return $profile;
            });
            return response()->json(["statusCode"=>'000','success' => true, 'data' => new ProfileResponse($profile)], 200);
        } catch (Exception $e) {
            return response()->json(["statusCode"=>'999','success' => false, 'message' => "System Error"], 500);
        }
    }

    public function update($request,$id)
    {
        //   dd($request->all());
        $profile =Profile::where('id',$id)->first();
        if ($profile == null) {
            return response()->json(["statusCode"=>'111','error' => 'data  Not Found'], 404);
        } else {
             $profile->update([
                'name_ar' => $request->nameAr??$profile->name_ar,
                'type' => $request->type??$profile->type,
                'iban' => $request->iban??$profile->iban,
                'vat_number' => $request->vatNumber??$profile->vat_number, 
            ]);
            if(isset($request['logo']))
            {
                $profile->addMedia($request->logo)->toMediaCollection('profileLogo');
            }
            return response()->json(["statusCode"=>'000','message' => 'updated successfully'], 200);
        }
    }

    public function show($id)
    {

        $profile = Profile::where('id', $id)->first();
        if ($profile != null) {
            return response()->json(["statusCode"=>'000','data' => new ProfileResponse($profile)], 200);
        } else {
            return response()->json(["statusCode"=>'111','error' => 'No data Founded'], 404);
        }
    }

    public function delete($id)
    {

        $profile = Profile::find($id)->first();

        $deleted = $profile->delete();
        if ($deleted) {
            return response()->json(["statusCode"=>'000','message' => 'deleted successfully'], 301);
        }
        return response()->json(["statusCode"=>'111','error' => 'system error'], 500);
    }

    public function restore($id)
    {
        $profile = Profile::where('id', $id)->withTrashed()->restore();
        if ($profile != null) {
            return response()->json(["statusCode"=>'000','message' => 'restored successfully'], 200);
        } else {
            return response()->json(["statusCode"=>'111','error' => 'No data Founded'], 404);
        }
    }


    public function swap_profile($id)
    {
        $company = Profile::find($id);
        $user = $company->users()->where('user_id', auth()->id())->first();
 
        if ($id == auth()->user()->profile_id) {
            $output = ["profile_id" => null, 'message' => "you are Already In this  profile", "statusCode" => "265"];
            return $output;
        }
        if ($user) {
            $payedSubscription = SubscriptionPayment::where('profile_id', $id)->where('status','Paid')->first();
            $profile = auth()->user();

            if($payedSubscription == null){
                $output = ["profile_id" => null, 'message' => "your Subscription expired", "statusCode" => "451"];
                return $output;
            }
            if (now() < $payedSubscription->expire_date) {
                $profile->update([
                    'profile_id' => $id
                ]);
                $output = ["profile_id" => $id, 'message' => "swaped successfully", "statusCode" => "000"];
                return $output;
            }
        }
        $output = ["profile_id" => null, 'message' => "Profile Not Founded", "statusCode" => "111"];
        return $output;
    }






    // public function unValidate()
    // {
    //     $unValidated = Profile::where('is_validated', '=', false)->get();
    //     if (empty($unValidated)) {
    //         return response()->json(['message' => 'all companys validated'], 200);
    //     }
    //     return response()->json(['data' => ProfileResponse::collection($unValidated)], 200);
    // }

    // public function validate($id)
    // {
    //     $profile = Profile::find($id);
    //     $validated = $profile->update(['is_validated' => true]);
    //     if ($validated) {
    //         return response()->json(['message' => 'validated successfully'], 200);
    //     }
    //     return response()->json(['error' => 'system error'], 500);
    // }

    public function pluckPermissions($type)
    {
        if ($type == "Buyer") {
            return DB::table('permissions')->where("category", "LIKE", "B%")->pluck('label');
        } elseif ($type == "Supplier") {
            return DB::table('permissions')->where("category", 'LIKE', "S%")->pluck('label');
        }
    }
}
