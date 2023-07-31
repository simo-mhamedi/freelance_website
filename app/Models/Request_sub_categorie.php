<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_sub_categorie extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'request_id',
        'subCategory_id',
    ];
    public function Sub_categorie()
    {
        return $this->belongsTo(Sub_categorie::class,'subCategory_id');
    }
    public function requests()
    {
        return $this->hasMany(Request::class, 'id');
    }

}
