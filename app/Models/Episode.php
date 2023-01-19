<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function section()
    {
       return $this->belongsTo(Section::class);
    }

    public function course()
    {
       return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function download(){
        $expire=now()->addDays(2)->timestamp;
        
        $hash=hash('sha1',env('EPISODES_SECRET_KEY').$this->id.request()->ip().$expire);

        return route('episode.download',['course'=>$this->section->course->slug,'number'=>$this->number,'key'=>$hash,'expire'=>$expire]);
    }
}
