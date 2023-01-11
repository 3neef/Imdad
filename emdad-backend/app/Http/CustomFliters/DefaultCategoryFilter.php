<?php


namespace App\Http\CustomFliters;

use App\Models\ProfileCategoryPivot;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class DefaultCategoryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if (Route::current()->uri == "api/v1_0/categories") {
            $query->where('status', "approved");
        } elseif (Route::current()->uri == "api/v1_0/categories/getCategoryProfile") {
            if ($value) {
                $CategoriesId = ProfileCategoryPivot::where("profile_id", $value['profile_id'])->pluck("category_id as CategoriesId");
                if ($value['onlyRequested'] == true) {
                    $query->whereIn('id', $CategoriesId)->where('profile_id', $value['profile_id']);
                } else {
                    $query->whereIn('id', $CategoriesId);
                }
            }
        }
    }
}
