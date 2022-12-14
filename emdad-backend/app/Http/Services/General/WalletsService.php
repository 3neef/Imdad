<?php

namespace App\Http\Services\General;


class WalletsService
{
    public static function create($profile)
    {
        $types = [
            'Buyer' => 'receiver',
            'Supplier' => 'sender',
        ];

        $profile->update(['profile_id' => $profile->id, 'type' => $types[$profile->type]]);
    }
}
