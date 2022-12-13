<?php

namespace App\Http\Services\AccountServices;

use App\Http\Requests\Profile\AddMoreCompanyRequest;
use App\Http\Resources\AccountResourses\Company\CompanyResponse;
use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Profile;
use App\Models\UM\RoleUserCompany;
use App\Models\User;
use Carbon\Carbon;

class AccountService
{
    public function addMoreCompany($request)
    {
        $company = RelatedCompanies::where("cr_number", $request->crNo)->first();
        
        $user = User::where('id', auth()->id())->first();

        $account = Profile::create([
            "type" => $request->companyType,
            "name_ar" => $company->cr_name,
            "cr_number"=>$company->cr_number,
            "created_by" => auth()->user()->id,
            "is_validated" => true,
        ]);

        $user->roleInProfile()->attach($user->id, ['roles_id' => $request['roleId'], 'profile_id' => $account->id, 'permissions' => $request->permissions]);

        $user->update(['profile_id' => $account->id]);

        return response()->json(['success' => true, 'message' => 'created successfully'], 200);
    }

    public function update($request)
    {
        $id = $request->get('id');
        $company = Profile::find($id);
        $name = empty($request->get('name')) ? $company->name : $request->get('name');
        $company_id = empty($request->get('companyId')) ? $company->company_id : $request->get('companyId');
        $company_type = empty($request->get('companyType')) ? $company->company_type : $request->get('companyType');
        $company_vat_id = empty($request->get('companyVatId')) ? $company->company_vat_id : $request->get('companyVatId');
        $contact_name = empty($request->get('contactName')) ? $company->contact_name : $request->get('contactName');
        $contact_phone = empty($request->get('contactPhone')) ? $company->contact_phone : $request->get('contactPhone');
        $contact_email = empty($request->get('contactEmail')) ? $company->contact_email : $request->get('contactEmail');
        $subs_id = empty($request->get('subscriptionId')) ? $company->subs_id : $request->get('subscriptionId');
        $subscription_details = empty($request->get('subscriptionDetails')) ? $company->subscription_details : $request->get('subscriptionDetails');
        $update = $company->update([
            'name' => $name, 'company_id' => $company_id, 'company_type' => $company_type,
            'company_vat_id' => $company_vat_id, 'contact_name' => $contact_name, 'contact_phone' => $contact_phone,
            'contact_email' => $contact_email, 'subs_id' => $subs_id, 'subscription_details' => $subscription_details
        ]);
        if ($update) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function getById($id)
    {
        $account = Profile::where('id', $id)->get();
        return response()->json(['data' => new ProfileResponse($account)], 200);
    }

    public function getAll()
    {
        $allAccounts = Profile::all();

        return response()->json(['data' => ProfileResponse::collection($allAccounts)], 200);
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        $deleted = $profile->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restore($id)
    {
        $restore = Profile::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function unValidate()
    {
        $unValidated = Profile::where('is_validated', '=', false)->get();
        if (empty($unValidated)) {
            return response()->json(['message' => 'all companys validated'], 200);
        }
        return response()->json(['data' => ProfileResponse::collection($unValidated)], 200);
    }

    public function validate($id)
    {
        $profile = Profile::find($id);
        $validated = $profile->update(['is_validated' => true]);
        if ($validated) {
            return response()->json(['message' => 'validated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
