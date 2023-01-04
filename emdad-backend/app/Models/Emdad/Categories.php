<?php

namespace App\Models\Emdad;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Categories extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name_en', 'name_ar', 'status', 'parent_id', 'isleaf', 'profile_id', 'reason', 'type'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function Products()
    {
        return $this->hasMany(Prodcuts::class);
    }

    public function companyCategory()
    {
        return $this->belongsToMany(Profile::class, 'profile_category_pivots', 'profile_id', 'category_id')
            ->withPivot('category_id')
            ->withTimestamps();
    }


    public function getCreatedByAttribute()
    {
    $createdById = DB::table('profile_category_pivots')->where('profile_id', auth()->user()->profile_id ?? null)->pluck('created_by');
        $createdByIdName = $this->createdByName($createdById);

        return ["mangerID" => $createdById, "mangerName" => $createdByIdName];
    }
    public function createdByName($createdById)
    {
        if (count($createdById) > 1) {
            foreach ($createdById as $createdBy) {
                return DB::table('users')->where('id', $createdBy)->pluck('full_name');
            }
        } else {
            return DB::table('users')->where('id', $createdById)->pluck('full_name');
        }
    }
}
