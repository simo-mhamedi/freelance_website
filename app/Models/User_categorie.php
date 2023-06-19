<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_categorie extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sub_category_id',
    ];
}
