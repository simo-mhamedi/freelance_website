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
        'viewsNumber',
        'user_id'
    ];

    public function Sub_categorie()
    {
        return $this->hasMany(Request_sub_categorie::class,"request_id");
    }
    public function RSub_categorie()
    {
        return $this->hasMany(Request_sub_categorie::class,"subCategory_id");
    }
    public function requests(): HasMany
{
    return $this->hasMany(Request::class, 'user_id');
}
public function estimates()
{
    return $this->hasMany(Estimate::class, 'request_id');
}


public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function getEstimateCountAttribute()
{
    return $this->estimates()->count();
}



public function estimate()
{
    return $this->belongsTo(Estimate::class);
}
}
