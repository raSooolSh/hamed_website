<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\VerifyCode;
use App\Notifications\VerifyCodeNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showResetPasswordForm(){
        return view('front.auth.resetPassword');
    }

    public function storeNewPassword(Request $request){

        $user=$this->getUserByMeliCode($request->meli_code);

        $request->validate([
            'password'=>['required','string','min:8','max:32','strong_password','confirmed'],
            'verify_code'=>['required',"verify_code:$user->phone_number"],
        ]);

        $user->update([
            'password'=>Hash::make($request->password)
        ]);

        return redirect(route('login'))->with('toast',['success'=>'پسورد جدید با موفقیت ثبت شد']);
    }


    public function sendVerifyCode(Request $request)
    {
        $request->validate([
            'meli_code' => ['required', 'string','digits:10','meli_code'],
        ]);
        $user=$this->getUserByMeliCode($request->meli_code);

        $verifyCodeRow=VerifyCode::generateCode($user->phone_number);

        //send sms
        $verifyCodeRow->notify(new VerifyCodeNotification());
    }


    /**
     * @throws ValidationException
     */
    protected function getUserByMeliCode($meli_Code)
    {
        $user=User::where('meli_code',$meli_Code)->first();

        if($user){
            return $user;
        }else{
            throw ValidationException::withMessages([
                'meli_code'=>'شماره ملی معتبر نمی باشد'
            ]);
        }
    }
}
