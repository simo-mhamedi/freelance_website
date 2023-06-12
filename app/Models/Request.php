<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'requestNumber',
        'title',
        'description',
        'price_min',
        'price_max',
        'date_request',
        'date_deadline',
        'status',
        'user_id'
    ];

    public function requests(): HasMany
{
    return $this->hasMany(Request::class, 'user_id');
}
}
