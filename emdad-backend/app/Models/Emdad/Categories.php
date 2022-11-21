<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
        
    protected $fillable = [ 'name', 'aproved','parent_id','isleaf','company_id'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function Products()
    {
        return $this->hasMany(Prodcuts::class);
    }
}
