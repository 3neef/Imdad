<?php

namespace App\Http\Services\AccountServices;

use App\Http\Requests\Profile\AddMoreCompanyRequest;
use App\Http\Resources\AccountResourses\Company\CompanyResponse;
use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Http\Services\General\WalletsService;
use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Profile;
use App\Models\UM\RoleUserCompany;
use App\Models\User;
use Carbon\Carbon;

class AccountService
{
    public function store($request)
    {
        $company = RelatedCompanies::where("cr_number", $request->crNo)->first();

        $user = User::where('id', auth()->id())->first();

        $account = Profile::create([
            "type" => $request->PrfoileType,
            "name_ar" => $company->cr_name,
            "cr_number" => $company->cr_number,
            "created_by" => auth()->user()->id,
            "is_validated" => true,
        ]);
        WalletsService::create($account);

        $user->roleInProfile()->attach($user->id, ['role_id' => $request['roleId'], 'profile_id' => $account->id, 'permissions' => $request->permissions]);

        $user->update(['profile_id' => $account->id]);

        return response()->json(['success' => true, 'message' => 'created successfully'], 200);
    }

    public function update($request, $id)
    {
        $profile = Profile::find($id);
        if ($profile == null) {
            return response()->json(['error' => 'data  Not Found'], 404);
        } else {
            $update = $profile->update([
                'name_ar' => $request->nameAr,
                'type' => $request->type,
                'iban' => $request->iban,
                'vat_number' => $request->vatNumber,
            ]);
            return response()->json(['message' => 'updated successfully'], 200);
        }
    }

    public function show($id)
    {

        $profile = Profile::where('id', $id)->first();
        if($profile!=null)
        {
            return response()->json(['data' => new ProfileResponse($profile)], 200);

        }
        else{
            return response()->json(['error' => 'No data Founded'], 404);

        }
    }

    public function delete($id)
    {

        $profile = Profile::find($id)->first();

        $deleted = $profile->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restore($id)
    {
        $profile = Profile::where('id', $id)->withTrashed()->restore();
        if($profile!=null)
        {
        return response()->json(['message' => 'restored successfully'], 200);

        }else{
            return response()->json(['error' => 'No data Founded'], 404);
        }
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
}
