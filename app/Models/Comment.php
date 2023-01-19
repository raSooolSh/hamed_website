<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function childs()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function bigParent()
    {
        while ($this->parent) {
            return $this->parent->bigParent();
        }
        return $this;
    }

    public function getCommentableTypeAttribute($commentable)
    {
        switch ($commentable) {
            case 'App\\Models\\Course':
                return 'دوره ها';
                break;
            case 'App\\Models\\Article':
                return 'مقالات';
                break;
            case 'App\\Models\\Episode':
                return 'اپیزود ها';
                break;
            default:
                return $commentable;
        }
    }
}
