<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Snippet extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function favoredByUsers(){
        return $this->belongsToMany(User::class, 'favorite_snippets');
    }

}
