<?php
namespace App\Http\Services\AccountServices;

use App\Http\Resources\AccountResourses\Company\CompanyResponse;
use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;

class AccountService{

    public function createCompany($request)
    {
        $account = new CompanyInfo();
        $account->name = $request->get('name');
        $account->company_id = $request->get('companyId');
        $account->company_type = $request->get('companyType');
        $account->company_vat_id = $request->get('companyVatId');
        $account->contact_name = $request->get('contactName');
        $account->contact_phone = $request->get('contactPhone');
        $account->contact_email = $request->get('contactEmail');
        $account->subs_id = $request->get('subscriptionId');
        $subscription = SubscriptionPackages::find($request->get('subscriptionId'));
        $account->subscription_details = $subscription->value('subscription_details');

        $result = $account->save();
        if($result){
            return response()->json( [ 'message'=>'created successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function update($request)
    {
        $id = $request->get('id');
        $company = CompanyInfo::find($id);
        $name = empty($request->get('name')) ? $company->name : $request->get('name');
        $company_id = empty($request->get('company_id')) ? $company->company_id : $request->get('company_id');
        $company_type = empty($request->get('company_type')) ? $company->company_type : $request->get('company_type');
        $company_vat_id = empty($request->get('company_vat_id')) ? $company->company_vat_id : $request->get('company_vat_id');
        $contact_name = empty($request->get('contact_name')) ? $company->contact_name : $request->get('contact_name');
        $contact_phone = empty($request->get('contact_phone')) ? $company->contact_phone : $request->get('contact_phone');
        $contact_email = empty($request->get('contact_email')) ? $company->contact_email : $request->get('contact_email');
        $subs_id = empty($request->get('subs_id')) ? $company->subs_id : $request->get('subs_id');
        $subscription_details = empty($request->get('subscription_details')) ? $company->subscription_details : $request->get('subscription_details');
        $update = $company->update(['name' => $name,'company_id' => $company_id,'company_type' => $company_type,
        'company_vat_id' => $company_vat_id,'contact_name' => $contact_name,'contact_phone' => $contact_phone,
        'contact_email' => $contact_email, 'subs_id' => $subs_id, 'subscription_details'=> $subscription_details]);
        if($update){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function getById($id)
    {
        $account = CompanyInfo::where( 'id', $id )->get();
        return response()->json( [ 'data'=>new CompanyResponse($account)  ], 200 );
    }

    public function getAll()
    {
        $allAccounts = CompanyInfo::all();
        return response()->json( [ 'data'=>CompanyResponse::collection($allAccounts) ], 200 );
    }

    public function delete($id)
    {
        $account = CompanyInfo::find($id);
        $deleted = $account->delete();
        if($deleted){
            return response()->json( [ 'message'=>'deleted successfully' ], 301 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function restore($id)
    {
        $restore = CompanyInfo::where('id', $id)->withTrashed()->restore();
        if($restore){
             return response()->json( [ 'message'=>'restored successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

}