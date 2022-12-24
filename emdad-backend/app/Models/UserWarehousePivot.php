<?php

namespace App\Models;

use App\Models\Accounts\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWarehousePivot extends Model
{
    use SoftDeletes;
    protected $table = 'user_warehouse_pivots';
    protected $fillable = ['user_id','warehouse_id','status'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_warehouse_pivots', 'user_id')->withTimestamps()->withPivot("status");
    }



    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'user_warehouse_pivots', 'warehouse_id')->withTimestamps()->withPivot("status");
    }



}
