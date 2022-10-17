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
        $user->company_id = $account->id;
        $user->mobile = $account->contact_phone;
        $user->save();
    }
}
