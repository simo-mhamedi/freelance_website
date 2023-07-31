<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_Rate extends Model
{
    use HasFactory;
    public function userrating()
    {
        return $this->belongsTo(UserRating::class, 'user_id');
    }
    protected $fillable = [
        'user_id',
        'estimate_id',
        'review'
    ];
}
