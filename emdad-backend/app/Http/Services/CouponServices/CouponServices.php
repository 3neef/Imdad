<?php

namespace App\Http\Services\CouponServices;

use App\Http\Resources\General\CouponResponse;
use App\Http\Resources\Rssources\SubscriptionResource;
use App\Models\Coupon\Coupon;
use App\Models\Emdad\Unit_of_measures;
use App\Models\SubscriptionPayment;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CouponServices
{

    public function create($request)
    {
             Coupon::create([
                'allowed' => $request->allowed,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'value' => $request->value,
                'is_percentage' => $request->isPercentage,
                'code' => random_int(100000,999999),
            ]);
            return response()->json(['message' => 'coupon created successfully'],200);

    }

    public function showCoupon(){
        $couponCode = Coupon::where('end_date','>',Carbon::now())->get();
        return  response()->json(['data' =>new CouponResponse( $couponCode)],200);
    }


     public function usedCoupon($request)
    {
        $coupon = Coupon::where('code',$request->code)->first();
        $subscription = SubscriptionPayment::where('id',$request->subscriptionpayment_id)->first();
        if($coupon->end_date > Carbon::now() && $coupon->allowed > $coupon ->used && $subscription->coupon_id==null){
            $coupon->update(['used'=>$coupon->used + 1,
             'user_id'=>auth()->id()
        ]);
            if($coupon->is_percentage===1){
                $subscription->update([
                    'coupon_id'=>$coupon->id,
                    'discount'=>$subscription->sub_total*$coupon->value/100,
                ]);
            }
            else{
                $subscription->update([
                    'coupon_id'=>$coupon->id,
                    'discount'=>$coupon->value,
                ]);
            }
            $subscription=$this->recalculate($subscription);
            return response()->json(['data'=>new SubscriptionResource($subscription),'message' => 'aproved successfully'], 200);
        }
        else{
            return response()->json(['message' => 'can,t use coupon'], 301);
        }
    }

    public function recalculate($subscriptionPayment)
    {
        $subscriptionPayment->sub_total=$subscriptionPayment->sub_total-$subscriptionPayment->discount;
        $subscriptionPayment->tax_amount=$subscriptionPayment->sub_total*15/100;
        $subscriptionPayment->total=$subscriptionPayment->sub_total+$subscriptionPayment->tax_amount;
        $subscriptionPayment->save();
        return $subscriptionPayment;
    }




    public function destroy( $id)
    {
        $category = Coupon::find($id);
        if ($category == null) {
            return response()->json(['success' => false, 'error' => 'not found'], 404);
        } else {
            $category->delete();
            return response()->json(['message' => 'deleted successfully'], 301);
        }
    }


    public function restore($id)
    {
        $restore = Coupon::where('id',$id)->where('deleted_at','!=',null)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }





    public function get_all_unit_of_measure()
    {
        $unit = Unit_of_measures::get();
        return response()->json( [ 'data'=>$unit], 200 );
    }

}
