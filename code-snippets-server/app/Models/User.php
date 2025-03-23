<?php

namespace App\Models;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Snippet;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject{
    use HasFactory, Notifiable;

    protected $hidden = [
        'password',
        'email',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function snippets(){
        return $this->hasMany(Snippet::class);
    }

    public function favoriteSnippets(){
        return $this->belongsToMany(Snippet::class, 'favorite_snippets');
    }

}
