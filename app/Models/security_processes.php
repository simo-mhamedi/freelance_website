<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class security_processes extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'rcCompany',
        'country',
    ];
}
