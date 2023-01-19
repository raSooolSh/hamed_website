<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=['message','is_owner'];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
