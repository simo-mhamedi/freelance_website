<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estimate extends Model
{
    use CrudTrait;
    use HasFactory;
    public function freelancer()
    {
        return $this->belongsTo(User::class,"freelancer_id");
    }
    public function client()
    {
        return $this->belongsTo(User::class,"client_id");
    }
    public function request()
    {
        return $this->belongsTo(request::class);
    }
    protected $fillable = [
        'reference',
        'request_id',
        'description',
        'freelancer_id',
        'client_id',
        'estimate_date',
        'rating',
        'file'
    ];

    public function setFileAttribute($value)
    {
        $attribute_name = "file";
        $disk = "public";
        $destination_path = 'files/files';
        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName = null);

    // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }
}
