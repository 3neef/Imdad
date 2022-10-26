<?php
namespace App\Http\Services\AccountServices;

use App\Http\Resources\AccountResourses\Location\LocationResponse;
use Carbon\Carbon;
use App\Models\Accounts\CompanyInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\CompanyLocations;
use App\Models\User;

class LocationService{

    public function save($request)
    {
        $location = new CompanyLocations();
        $user = auth()->user();// get user_id if user requested by token (before add middlware)
        // $userId = User::find($request->get('userId')) ; //for test
        $companyId = $user->default_company;
        $otp = rand(100000, 999999);
        $otpExpireAt = Carbon::now()->addMinutes(3);
        $location->address_name = $request->get('warehouseName');
        $location->company_id = $companyId;
        $location->address_contact_phone = $request->get('receiverPhone');
        $location->latitude_longitude = $request->get('location');
        $location->address_contact_name = $request->get('receiverName');
        $location->address_type = $request->get('warehouseType');
        $location->gate_type = $request->get('gateType');
        $location->otp_receiver = $otp;
        $location->otp_expires_at = $otpExpireAt;
        $location->created_by=$user->id;

        $result = $location->save();
        if($result){
            return response()->json( [ 'message'=>'created successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function update($request)
    {
        $id = $request->get('id');
        $location = CompanyLocations::find($id);
        $address_name = empty($request->get('warehouseName')) ? $location->address_name : $request->get('warehouseName');
        $address_type = empty($request->get('warehouseType')) ? $location->address_type : $request->get('warehouseType');
        $gate_type = empty($request->get('gateType')) ? $location->gate_type : $request->get('gateType');
        $address_contact_name = empty($request->get('receiverName')) ? $location->address_contact_name : $request->get('receiverName');
        $address_contact_phone = empty($request->get('receiverPhone')) ? $location->address_contact_phone : $request->get('receiverPhone');
        $latitude_longitude = empty($request->get('location')) ? $location->latitude_longitude : $request->get('location');
        $update = $location->update(['address_name' => $address_name,'address_type' => $address_type,'gate_type' => $gate_type,'address_contact_name' => $address_contact_name,'address_contact_phone' => $address_contact_phone,'latitude_longitude' => $latitude_longitude]);
        if($update){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function showById($id)
    {
        $location = CompanyLocations::where( 'id', $id )->get();
        return response()->json( [ 'data'=>new LocationResponse($location)  ], 200 );
    }
    public function showByUserId($id)
    {
        $userId = User::find($id)->id;
        $location = CompanyLocations::where( 'confirm_by', $userId )->first();
        return response()->json( [ 'data'=>new LocationResponse($location) ], 200 );
    }
    public function showByCompanyId($id)
    {
        $location = CompanyLocations::where( 'company_id', $id );
        return response()->json( [ 'data'=> LocationResponse::collection($location) ], 200 );
    }

    public function getAll()
    {
        $allLocations = CompanyLocations::all();
        return response()->json( [ 'data'=> LocationResponse::collection($allLocations)  ], 200 );
    }

    public function delete($id)
    {
        $location = CompanyLocations::find($id);
        $deleted = $location->delete();
        if($deleted){
            return response()->json( [ 'message'=>'deleted successfully' ], 301 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }
    public function restore($id)
    {
        $restore = CompanyLocations::where('id', $id)->withTrashed()->restore();
        if($restore){
             return response()->json( [ 'message'=>'restored successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function verfied($request){
        $userId = $request->get('userId');
        $id = $request->get('id');
        $companyId = $request->get('companyId');
        $location = CompanyLocations::where('id','=',$id)->where('company_id','=',$companyId)->first();
        $verfied = $location->update(['confirm_by' => $userId,'otp_receiver' => null , 'otp_expires_at' => null , 'otp_verfied' => true]);
        if($verfied){
            return response()->json( [ 'message'=>'verfied successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    } 
}