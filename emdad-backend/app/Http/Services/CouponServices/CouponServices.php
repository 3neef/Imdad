<?php

namespace App\Http\Services\CouponServices;

use App\Models\Coupon\Coupon;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;

class CouponServices
{

    public function createCoupon($request)
    {
            $coupon = Coupon::create([
                'allowed' => $request->allowed,
                'start_date' => $request->stratDate,
                'end_date' => $request->endDate,
                'value' => $request->value,
                'is_percentage' => $request->isPercentage,
                'code' => random_int(100000,999999),
            ]);
            return response()->json(['message' => 'coupon created successfully'],200);

    }

    public function showCoupon(){
        $couponCode = Coupon::where('end_date','>',Carbon::now())->get();
        return  response()->json(['data' => $couponCode],200);
    }

     public function usedCoupon($coupon)
    {
        $c = Coupon::where('code',$coupon)->first();
        if($c->end_date > Carbon::now() && $c->allowed > $c ->used){
            $c->update(['used'=>$c->used + 1]);
            return response()->json(['message' => 'aproved successfully'], 200);
        }
        else{
            return response()->json(['message' => 'can,t use coupon'], 301);
        }
    }
}
