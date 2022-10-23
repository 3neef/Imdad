<?php

namespace App\Observers;

use App\Models\Accounts\CompanyInfo;
use App\Models\User;

class AccountsObserver
{
    public function created(CompanyInfo $account)
    {
        $user = new User();
        $user->name = $account->contact_name;
        $user->email = $account->contact_email;
        //dd($account);
        $user->company_id = $account->id;
        $user->is_super_admin = true;
        $user->mobile = $account->contact_phone;
        $user->save();
        $updateAccount = CompanyInfo::find($account->id);
        $updateAccount ->update(['created_by'=>$user->id]);
    }
}
