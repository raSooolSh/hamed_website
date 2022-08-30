<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Notifications\VerifyCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\VerifyCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

       /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'meli_code' => ['required', 'string','digits:10','meli_code','unique:users'],
            'phone_number' => ['required', 'string','digits:11','regex:/^09\d{9}/','unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:32' ,'strong_password'],
            'verify_code'=>['required',"verify_code:$data[phone_number]"],
            'terms'=>['required',"in:on"],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'meli_code' => $data['meli_code'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

     /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return redirect(RouteServiceProvider::HOME)->with('toast',['success'=>'تبریک: به جمع کریپتولوژی ها خوش اومدی']);
    }



    public function sendVerifyCode(Request $request){
        $request->validate([
            'phone_number'=>['required','digits:11','regex:/^09\d{9}/','unique:users']
        ]);

        $verifyCodeRow=VerifyCode::generateCode($request->phone_number);

        //send sms
        $verifyCodeRow->notify(new VerifyCodeNotification());
    }
}
