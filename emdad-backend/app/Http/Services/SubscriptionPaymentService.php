<?php

namespace App\Http\Services;

use App\Models\Accounts\SubscriptionPackages;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;

class SubscriptionPaymentService
{

    public function addSubscriptionPayment($request)
    {


        $subscription = SubscriptionPackages::where('id', $request->subscription_id)->first();

        $subscription_info=json_decode($subscription->subscription_details,true);


        $SubscriptionPayment = SubscriptionPayment::create([
            'profile_id' => auth()->user()->profile_id ?? 2,
            'subscription_id' => $request->subscription_id,
            'user_id' => auth()->id() ?? 2,
            'sub_total' => $subscription_info['price'],
            'days' => $this->checkType($request),
            'tax_amount' => 15,
            'total' => ($subscription_info['price'] + ($subscription_info['price']* 15)/ 100),
        ]);
        return response()->json(['data' => $SubscriptionPayment], 200);
    }

    private function checkType($request)
    {
        $dt=new Carbon();

        if ($request->type == "Monthly") {
            $days = $dt->addMonth();
        } else if($request->type == "Yearly"){
            $days = $dt->addYear();
        }
        return $days;
    }
}
