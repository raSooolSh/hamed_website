<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VerifyCode extends Model
{
    use HasFactory,notifiable;

    protected $guarded=[];

    protected $table='verify_codes';

    public function scopeGenerateCode($query,$phone_number)
    {
        $currentCodes=$this->where('phone_number',$phone_number)->get();
        foreach($currentCodes as $item){
            $item->delete();
        }

        $newCode='';
        for($i=1;$i<=6;$i++){
            $newCode.=mt_rand(0,9);
        }

        $codeRow=$this->create([
            'phone_number'=>$phone_number,
            'code'=>$newCode,
            'expired_at'=>Carbon::now()->addMinutes(3),
        ]);

        return $codeRow;
    }
}
