<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'swift',
        'iban',
        'created_by',
        'type',
        'bank',
        'vat_number',
        'cr_number'
    ];

    public function wallet () {
        return $this->morphOne(Wallet::class, 'accountable');
    }

    public function trucks () {
        return $this->morphMany(Truck::class, 'manageable');
    }

    public function drivers () {
        return $this->morphMany(Driver::class, 'manageable');
    }

    public function products () {
        return $this->hasMany(Product::class);
    }
    public function parent () {
        return $this->belongsTo(Profile::class, 'parent_id');
    }

    public function subscriptions () {
        return $this->morphMany(Subscription::class, 'subscribed');
    }
}
