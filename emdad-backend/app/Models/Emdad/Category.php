<?php

namespace App\Models\Emdad;

use App\Models\Profile;
use App\Models\ProfileCategoryPivot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['name_en', 'name_ar', 'status', 'parent_id', 'isleaf', 'profile_id', 'created_by', 'reason', 'type'];
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

    public function sequence()
    {
        $current = $this;
        $lang = auth()->user()->lang;
        $sequence = "";
        while ($current != null && $current->parent_id != 0) {
            $current = Category::where("id", $current->parent_id)->first();
            if ($lang == "en" || $lang == null) {
                $sequence = $current->name_en . "/" . $sequence;
            } else {
                $sequence = $current->name_ar . "/" . $sequence;
            }
        }

        return $sequence;
    }

    public function companyCategory()
    {
        return $this->belongsToMany(Profile::class, 'profile_category_pivots', 'profile_id', 'category_id')
            ->withPivot('category_id')
            ->withTimestamps();
    }


    public function CreatorName()
    {
        return ProfileCategoryPivot::where('profile_id',auth()->user()->profile_id)->where("user_id",$this->created_by)->first();
        
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)
        ->withPivot(['user_id'])
        ->withTimestamps()
        ->as('profile');
    }

}
