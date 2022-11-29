<?php
namespace App\Http\Services\AccountServices;

use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;

class SubscriptionService{


    public function update($request)
    {
        $id = $request->get('id');
        $subscription = SubscriptionPackages::find($id);
        $subscriptionDetails = empty($request->get('subscriptionDetails')) ? $subscription->subscription_details : $request->get('subscriptionDetails');
        $update = $subscription->update(['subscription_details' => $subscriptionDetails]);
        $updateOld = $request->get('updateOld');
        if($updateOld){
            $allCompanys = CompanyInfo::where('subs_id','=',$id);
            $allCompanys->update(['subscription_details'=>$subscriptionDetails]);
        }

        if($update){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }


    public function create($request)
    {
       
     $subscription=new SubscriptionPackages();
     $subscription->subscription_name=$request->packageName;
     $subscription->type=$request->type;
     $subscription->subscription_details=json_encode($request->subscriptionDetails);

     $subscription->save();
            return response()->json( [ 'message'=>'created successfully' ], 200 );
    }

}