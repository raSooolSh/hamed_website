<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory,Sluggable;

    protected $guarded=[];

    public function sluggable(): array
    {
        return[
            'slug'=>[
                'source'=>'title'
            ]
        ];
    }

    public function getTypeAttribute($type){
        if($type=='news'){
            return 'خبری';
        }elseif($type=='article'){
            return 'مقاله';
        }
    }

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
