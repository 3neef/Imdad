<?php

namespace App\Models\Accounts;

use App\Models\User;
use App\Models\UserWarehousePivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = "warehouses";
    protected $fillable = [
        'address_name',
        'profile_id',
        'address_contact_phone',
        'latitude',
        'longitude',
        'address_contact_name',
        'address_type',
        'gate_type',
        'otp_receiver',
        'otp_expires_at',
        'otp_verfied',
        'confirm_by',
        'created_by',
        'status',
        'manager_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class,'user_warehouse_pivots')->withPivot('user_id')->withTimestamps();
    // }
    public function manager()
    {
         return User::where('id',$this->manager_id)->first();
    }

    public function users()
    {
         return UserWarehousePivot::where('warehouse_id',$this->id)->get();
    }
    
    public function creatorName()
    {
        return User::where('id',$this->created_by)->first();
        
    }
}
