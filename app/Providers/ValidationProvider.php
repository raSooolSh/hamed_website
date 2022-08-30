<?php

namespace App\Providers;

use App\Models\VerifyCode;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator as BaseValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // check verify code input with database
            Validator::extend('verify_code',function($attr,$value,$parameter=[],BaseValidator $validator){
                $code=VerifyCode::where('phone_number',$parameter[0])->where('expired_at','>',Carbon::now())->first();
                if(is_null($code)){
                    return false;
                }
                return $code->code===$value;
            },);
        // /check verify code input with database

        // code meli validation
        Validator::extend('meli_code',function($attr,$value,$parameter=[],BaseValidator $validator){

            // check length
                if(! preg_match('/^\d{10}$/',$value)){
                    return false;
                }
            // /check length

            // convert string to array and then meli code validatation
                $split=str_split($value);
                $index=10;
                $sum=0;
                foreach($split as $value){
                    if($index>1){
                        $sum+=$value*$index;
                        $index--;
                    }
                }


                $result=$sum%11;
                if($result>1){
                    return 11-$result == $split[9] ? true : false;
                }elseif($result<=1){
                    return $result == $split[9] ? true : false;
                }
            // /convert string to array and then meli code validatation

            return false;
        },);

        // password validation
        Validator::extend('strong_password',function($attr,$value,$parameter=[],BaseValidator $validator){
            if(! preg_match('/^(?=.*[[:alpha:]])(?=.*\d).{8,32}$/',$value)){
                return false;
            }
            return true;
        },);
        // /password validation
    }
}
