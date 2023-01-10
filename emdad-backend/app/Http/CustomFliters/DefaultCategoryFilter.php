<?php


namespace App\Http\CustomFliters;

use App\Models\ProfileCategoryPivot;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class DefaultCategoryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (Route::current()->uri == "api/v1_0/categories") {
            $query->where('status', "approved");
        } elseif(Route::current()->uri == "api/v1_0/categories/getCategoryProfile") {
            if ($value) {
                if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                    $categories = ProfileCategoryPivot::where("profile_id", $value->profile_id)->pluck("profile_id as profileId");
                    $query->whereIn('profile_id', $categories);
                }
            }
        }
    }
}
