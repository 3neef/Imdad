<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackages extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_name', 'subscription_details', 'created_at'
    ];
}
