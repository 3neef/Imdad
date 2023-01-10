<?php


namespace App\Http\CustomFliters;

use App\Models\ProfileCategoryPivot;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DefaultCategoryFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                $categories = ProfileCategoryPivot::where("profile_id", $value->profile_id)->pluck("profile_id as profileId");
                $query->whereIn('profile_id', $categories);
            }
        }
    }
}
