<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'membership_id',
        'user_id',
        'estimates_restNumber',
        'estimates_number',
    ];
}
