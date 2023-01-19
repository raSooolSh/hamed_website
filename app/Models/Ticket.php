<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class,'phone_number','phone_number');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
