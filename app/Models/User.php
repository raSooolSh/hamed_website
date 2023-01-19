<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function premissions(){
        return $this->belongsToMany(Premission::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function episodes(){
        return $this->belongsToMany(Episode::class)->withPivot('request');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class,'phone_number','phone_number');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }


    public function hasAccessToAdminPanel(){
        if($this->type=='admin' || $this->type=='manager'){
            return true;
        }
        return false;
    }

    public function hasRole($roles)
    {
        return !! $roles->intersect($this->roles)->all();
    }

    public function hasPremission($premission){
        return $this->premissions->contains('name',$premission->name) || $this->hasRole($premission->roles);
    }
}
