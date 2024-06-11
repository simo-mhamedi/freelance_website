<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freelancerSuggestion extends Model
{
    use HasFactory;
    public function freelancer() {
        return $this->belongsTo(User::class);
    }
    public function article() {
        return $this->belongsTo(articles::class);
    }
}
