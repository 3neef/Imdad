<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'created_by',
        'name_ar',
        'name_en',
        'swift',
        'iban',
        'type',
        'bank',
        'vat_number',
        'cr_number',
        'cr_expire_data',
        'subs_id',
        'subscription_details',
        'active'
    ];

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'accountable');
    }

    public function trucks()
    {
        return $this->morphMany(Truck::class, 'manageable');
    }

    public function drivers()
    {
        return $this->morphMany(Driver::class, 'manageable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parent()
    {
        return $this->belongsTo(Profile::class, 'parent_id');
    }

    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscribed');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class, 'profile_department_user'
        )->withPivot('department_id')
        ->withTimestamps();

        ;
    }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class, 'profile_department_user'
        )->withPivot('user_id')
        ->withTimestamps();

        ;
    }

}
