<?php

namespace App\Http\Services\AccountServices;

use App\Http\Requests\AccountRequests\Account\AddMoreCompanyRequest;
use App\Http\Resources\AccountResourses\Company\CompanyResponse;
use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Emdad\RelatedCompanies;
use App\Models\User;
use Carbon\Carbon;

class AccountService
{
    public function addMoreCompany( $request)
    {
        $company=RelatedCompanies::where("cr_number",$request->crNo)->first();

        $account=CompanyInfo::create([
            "company_type"=>$request->companyType,
            "company_name"=>$company->cr_name,
            "created_by"=>auth()->user()->id,
            
        ]);

        return response()->json(['success'=>true,'message'=>'created successfully'], 200);

    }

    public function createCompany($request)
    {
        $account = new CompanyInfo();
  
        $account->company_type = $request->get('companyType');
    
        $account->contact_phone = $request->get('contactPhone');
        $account->contact_email = $request->get('contactEmail');
        if (isset($request->subscriptionId)) {
            $account->subs_id = $request->get('subscriptionId');
            $subscription = SubscriptionPackages::find($request->get('subscriptionId'));
            $account->subscription_details = $subscription->value('subscription_details');
        }

        $result = CompanyInfo::create($account->toArray());

        if ($result) {
            $user=$this->createUser($result,$request);
            // $token = $user->createToken('authtoken');
            return response()->json(['success'=>true,'data'=>["user"=>$user]], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function createUser(CompanyInfo $account,$request)
    {
        $user = new User();
        $otp = rand(1000, 9999);
        $otp_expires_at = Carbon::now()->addMinutes(2);
        $user->full_name = $request->firstName." ".$request->lastName;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->identity = $request->personId;
        $user->identity_type = $request->idType;
        $user->email = $account->contact_email;
        
        //dd($account);
        $user->default_company = $account->id;
        $user->is_super_admin = true;
        $user->mobile = $account->contact_phone;
        $user->otp = strval($otp);
        $user->otp_expires_at = $otp_expires_at;
        
        $user->save();
        $user->roleInCompany()->attach($user->id,['roles_id' =>$request->roleId,'company_info_id'=>$account->id]);

        $updateAccount = CompanyInfo::find($account->id);
        $updateAccount ->update(['created_by'=>$user->id]);
        return $user;
    }

    public function update($request)
    {
        $id = $request->get('id');
        $company = CompanyInfo::find($id);
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
        $account = CompanyInfo::where('id', $id)->get();
        return response()->json(['data' => new CompanyResponse($account)], 200);
    }

    public function getAll()
    {
        $allAccounts = CompanyInfo::all();
        return response()->json(['data' => CompanyResponse::collection($allAccounts)], 200);
    }

    public function delete($id)
    {
        $account = CompanyInfo::find($id);
        $deleted = $account->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restore($id)
    {
        $restore = CompanyInfo::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function unValidate()
    {
        $unValidated = CompanyInfo::where('is_validated', '=', false)->get();
        if (empty($unValidated)) {
            return response()->json(['message' => 'all companys validated'], 200);
        }
        return response()->json(['data' => CompanyResponse::collection($unValidated)], 200);
    }

    public function validate($id)
    {
        $company = CompanyInfo::find($id);
        $validated = $company->update(['is_validated' => true]);
        if ($validated) {
            return response()->json(['message' => 'validated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
