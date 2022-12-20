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

        $subscription = SubscriptionPackages::where('id', $request->subscriptionId)->first();
        // dd($user->BasicPackage());
        if ($user->BasicPackage() == true && $subscription->subscription_name == 'basic') {
            return response()->json(['susscess' => false, 'message' => "you have already used the basic package"], 403);
        }

        $subscription_info = json_decode($subscription->subscription_details, true);

        $SubscriptionPayment = SubscriptionPayment::create([
            'profile_id' => auth()->user()->profile_id ?? 2,
            'subscriptionId' => $request->subscriptionId,
            'user_id' => auth()->id() ?? 2,
            'sub_total' => $subscription_info['price'],
            'days' => $dt->addDays(365),
            'tax_amount' => 15,
            'total' => ($subscription_info['price'] + ($subscription_info['price'] * 15) / 100),
        ]);
        $user->profile()->update(['subs_id' => $request->subscriptionId, 'subscription_details' => $subscription_info]);

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
