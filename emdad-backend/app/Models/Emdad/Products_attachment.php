<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Products_attachment extends Model
{

    use HasFactory,SoftDeletes;

    protected $fillable = ['id', 'file_type_id', 'product_id','path'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];



    public function file_type()
    {
        return $this->belongsTo(File_types::class);
    }
}
