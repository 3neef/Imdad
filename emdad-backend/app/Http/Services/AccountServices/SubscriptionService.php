<?php

namespace App\Http\Services\AccountServices;

use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;

class SubscriptionService
{


    public function store($request)
    {

        $subscription = SubscriptionPackages::create([
            'subscription_name' => $request->packageName,
            "type" => $request->type,
            "subscription_details" => json_encode($request->subscriptionDetails, true),
        ]);
        if ($subscription) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['message' => 'system error'], 500);
    }


    public function show($id)
    {
        $subscription = SubscriptionPackages::find($id);
        if ($subscription) {
            return response()->json(['data' => $subscription], 200);
        }
        return response()->json(['message' => 'system error'], 500);
    }


    public function update($request, $id)
    {

        $subscription = SubscriptionPackages::find($id);
        $subscription->update([
            'subscription_name' => $request->packageName ?? $subscription->subscription_name,
            "type" => $request->type ?? $subscription->type,
            "subscription_details" => json_encode($request->subscriptionDetails, true) ?? $subscription->subscription_details,
        ]);

        if ($subscription) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function destroy($id)
    {
        $subscription = SubscriptionPackages::find($id);
        $sub = $subscription->delete();
        if ($sub) {
            return response()->json(['message' => 'deleted successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function restore($id)
    {
        $subscription = SubscriptionPackages::where('id',$id)->where('deleted_at',"!=",null)->withTrashed()->restore();

        if ($subscription) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
