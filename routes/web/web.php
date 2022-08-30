<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// ------ auth route -------
Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class,'register']);
Route::post('/register/sendVerifyCode',[RegisterController::class,'sendVerifyCode'])->middleware(['throttle:6,60']);
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::get('/reset-password',[ResetPasswordController::class,'showResetPasswordForm'])->name('resetPassword');
Route::post('/reset-password',[ResetPasswordController::class,'storeNewPassword']);
Route::post('/reset-password/sendVerifyCode',[ResetPasswordController::class,'sendVerifyCode'])->middleware(['throttle:6,60']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
// ----- /auth route --------

// ----- dashboard ------
Route::get('/dashboard',fn()=>'dashboard')->name('dashboard');
// ----- /dashboard ------
