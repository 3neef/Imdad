<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodcuts extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'categories_id','price'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
