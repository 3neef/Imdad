<?php

namespace App\Observers;

use App\Models\Accounts\CompanyInfo;
use App\Models\User;
use Carbon\Carbon;

class AccountsObserver
{
    public function created(CompanyInfo $account)
    {
        $user = new User();
        $otp = rand(100000, 999999);
        $otp_expires_at = Carbon::now()->addMinutes(2);
        $user->full_name = $account->first_name." ".$account->last_name;
        $user->first_name = $account->first_name;
        $user->last_name = $account->last_name;
        $user->email = $account->contact_email;
        $user->roleInCompany()->attach($user->id,['roles_id' =>$account->roles_id,'company_info_id'=>$account->id]);
        
        //dd($account);
        $user->default_company = $account->id;
        $user->is_super_admin = true;
        $user->mobile = $account->contact_phone;
        $user->otp = strval($otp);
        $user->otp_expires_at = $otp_expires_at;
        $user->save();
        $updateAccount = CompanyInfo::find($account->id);
        $updateAccount ->update(['created_by'=>$user->id]);
    }
}
