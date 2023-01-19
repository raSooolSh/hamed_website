<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getTypeAttribute($type){
        if($type == 'percent'){
            return 'درصدی';
        }elseif($type='value'){
            return 'مبلغی';
        }
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
