<?php

namespace App\Observers;

use App\Models\Accounts\CompanyInfo;
use App\Models\User;

class AccountsObserver
{
    public function created(CompanyInfo $account)
    {
        $typeArray = [0 => 'emdad',1 => 'buyer' ,2 => 'supplier'];
        $user = new User();
        $user->name = $account->contact_name;
        $user->email = $account->contact_email;
        $user->type = $typeArray[$account->company_type];
        $user->company_id = $account->id;
        $user->save();
    }
}
