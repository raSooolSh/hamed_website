<?php

use Carbon\Carbon;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NewsController;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EpisodeController;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PurchaseController;

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

Route::get(
    '/ff',
    function () {
        $coins = Coin::ALL();
        foreach ($coins as $coin) {
            $url = 'https://s3.coinmarketcap.com/generated/sparklines/web/7d/2781/' . $coin->cmc_id . '.svg';
            $chart = Http::get($url)->body();
            preg_match('/(?=<svg)[\s\S]*/', $chart, $svg);
            $svg = $svg[0];
            $svg = preg_replace('/width="164px"/', 'width="185px"', $svg);
            $svg = preg_replace('/height="48px"/', 'height="80px"', $svg);
            if ($coin->change_last_week >= 0) {
                $svg = preg_replace('/stroke:rgb\(237,194,64\)/', 'stroke:rgb(0,200,0)', $svg);
            } else {
                $svg = preg_replace('/stroke:rgb\(237,194,64\)/', 'stroke:rgb(200,0,0)', $svg);
            }

            $coin->chart = $svg;
            $coin->save();
        }
    }
);
Route::view('/', 'welcome')->name('homepage');
// ------ auth route -------
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/register/sendVerifyCode', [RegisterController::class, 'sendVerifyCode'])->middleware(['throttle:6,60']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('resetPassword');
Route::post('/reset-password', [ResetPasswordController::class, 'storeNewPassword']);
Route::post('/reset-password/sendVerifyCode', [ResetPasswordController::class, 'sendVerifyCode'])->middleware(['throttle:6,60']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ----- /auth route --------

// ----- image converter
Route::get('/image', [ImageController::class, 'get'])->name('image.get');
Route::get('/image/upload', [ImageController::class, 'upload'])->name('image.upload');
// ----- /image converter

// ----- dashboard ------
Route::get('/dashboard', fn () => 'dashboard')->name('dashboard');
// ----- /dashboard ------


// -----Courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('courses/{course:slug}/invoice',[CourseController::class,'invoice'])->name('course.invoice');
// -----/Courses

// -----Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// -----/Articles

// -----Articles
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
// -----/Articles




// -----episodes
Route::get('/vip/{course:slug}/episode/{number}', [EpisodeController::class, 'download'])->name('episode.download');
Route::get('/course/{course:slug}/episode/{number}', [EpisodeController::class, 'show'])->name('episode.show');
// -----/episodes

// -----comments
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
// -----/comments


// -----payment
Route::post('courses/{course:slug}/payment',[PaymentController::class,'payment'])->name('payment')->middleware('auth');
Route::get('courses/{course:slug}/payment-verify',[PaymentController::class,'verify'])->name('payment_verify');
// -----/payment

// -----ajax
Route::post('discount-check',[DiscountController::class,'check'])->name('discountCheck');
// -----/ajax
