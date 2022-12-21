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

        $payedSubscription = SubscriptionPayment::where('id', auth()->user()->profile_id)->first();
        // dd($payedSubscription);
        // if ($payedSubscription->days null || $payedSubscription->days < now()) {
        //     return response()->json(['success' => false, "error" => "you are Already subscribed to another package "], 404);
        // }

        $oldOwner = $user->oldOwner();
        $price = $oldOwner ? $subscription->price_2 : $subscription->price_1;
        $SubscriptionPayment = SubscriptionPayment::create([
            'profile_id' => auth()->user()->profile_id,
            'package_id' => $request->packageId,
            'user_id' => auth()->id(),
            'sub_total' => $price,
            'days' => $dt->addDays(365),
            'tax_amount' => $price * 15 / 100,
            'total' => ($price + ($price * 15 / 100)),
            "status" => "Paid",
        ]);
        $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => json_encode($subscription->features, true)]);

        return response()->json(['data' => $SubscriptionPayment], 200);
    }



    public function check_subscription_payment()
    {
        $status = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->pluck('status')->first();
        if ($status) {
            return response()->json(['status' => $status], 200);
        } else {
            return response()->json(['message' => 'error'], 500);
        }
    }
}
