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

        $payedSubscription = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->first();
        // dd($payedSubscription);

        // dd($payedSubscription);

        if ($payedSubscription == null ||  now() > $payedSubscription->expire_date) {

            $oldOwner = $user->oldOwner();

            $price = $oldOwner == true ? $subscription->price_2 : $subscription->price_1;
            // dd($subscription);
            $SubscriptionPayment = SubscriptionPayment::create([
                'profile_id' => auth()->user()->profile_id,
                'package_id' => $request->packageId,
                'user_id' => auth()->id(),
                'sub_total' => $price,
                'expire_date' => $dt->addYear(),
                'tax_amount' => $price * 15 / 100,
                'total' => ($price + ($price * 15 / 100)),
                "status" => "Paid",
            ]);
            $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => json_encode($subscription->features, true)]);

            return response()->json(['data' => $SubscriptionPayment, "oldOwner" => $oldOwner], 200);
        } else {

            return response()->json(['success' => false, "error" => "you  have ALready  Active Subscriptions "], 404);
        }
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




    public function delete($id)
    {

        $subscription = SubscriptionPayment::find($id)->first();

        $deleted = $subscription->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
