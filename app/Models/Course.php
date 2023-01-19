<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory,Sluggable;

    protected $guarded=[];

    public function sluggable(): array
    {
        return[
            'slug'=>[
                'source'=>'name_en'
            ]
        ];
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function episodes(){
        return $this->hasMany(Episode::class);
    }

    public function discount(){
        if($this->discount_off && $this->discount_expire_at > now()){
            return $this->discount_off;
        }else{
            return false;
        }
    }
    public function discounts(){
        return $this->belongsToMany(Discount::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
