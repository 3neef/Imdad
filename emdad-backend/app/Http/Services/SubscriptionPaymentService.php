<?php

namespace App\Http\Services;

use App\Models\Accounts\SubscriptionPackages;
use App\Models\SubscriptionPayment;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionPaymentService
{

    public function store($request)
    {

        $dt = new Carbon();

        $user = User::where('id', auth()->id())->first();

        $subscription = SubscriptionPackages::where('id', $request->packageId)->first();
        $subscription_info = json_decode($subscription->features, true);
        $oldOwner=$user->oldOwner();
        $price = $oldOwner?$subscription_info->price2:$subscription_info->price1;
        $SubscriptionPayment = SubscriptionPayment::create([
            'profile_id' => auth()->user()->profile_id ,
            'package_id' => $request->packageId,
            'user_id' => auth()->id() ?? 2,
            'sub_total' => $price,
            'days' => $dt->addDays(365),
            'tax_amount' => $price*15/100,
            'total' => ($price + ($price* 15 / 100)),
        ]);
        $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => $subscription_info->features]);

        return response()->json(['data' => $SubscriptionPayment], 200);
    }



    public function check_subscription_payment()
{
    $status = SubscriptionPayment::where('profile_id',auth()->user()->profile_id)->pluck('status')->first();
    if($status){
        return response()->json(['status' => $status], 200);
    }
    else{
        return response()->json(['message' => 'error'], 500);
    }

}
}
