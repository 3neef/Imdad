<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
        'pending',
        'card_number',
        'password',
        'main',
        'type',
        'status'
    ];

    protected $hidden = ['password'];
    
    public function accountable()
    {
        return $this->morphTo();
    }
}
