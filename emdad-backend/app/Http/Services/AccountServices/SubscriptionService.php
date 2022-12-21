<?php

namespace App\Http\Services\AccountServices;

use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;

class SubscriptionService
{


    public function store($request)
    {

        $subscription = SubscriptionPackages::create([
            'price_1'=>$request->price1, 
            'price_2'=>$request->price2, 
            'free_first_time' => $request->freeFirstTime ,
            'package_name_ar' => $request->packageNameAr ,
            'package_name_en' => $request->packageNameEn ,
         
            "type" => $request->type,
            "features" => json_encode($request->features, true),
        ]);
        if ($subscription) {
            return response()->json(['success'=>true,'data' => $subscription], 200);

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
            'price_1' => $request->price1 ?? $subscription->price_1,
            'price_2' => $request->price2 ?? $subscription->price_2,
            'free_first_time' => $request->freeFirstTime ?? $subscription->free_first_time,
            'package_name_ar' => $request->packageNameAr ?? $subscription->package_name_ar,
            'package_name_en' => $request->packageNameEn ?? $subscription->package_name_en,
            "type" => $request->type ?? $subscription->type,
            "features" => json_encode($request->features, true) ?? $subscription->features,
        ]);

        

        if ($subscription) {
            return response()->json(['success'=>true,'data' => $subscription], 200);
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
