<?php

/*
---------------------------------------------------
admin panel routes
---------------------------------------------------
*/

use App\Models\Coin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\TicketController;
use App\Http\Controllers\admin\ArticleController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\PremissionController;
use App\Http\Controllers\admin\UserDownloadController;
use App\Http\Controllers\admin\UserPremissionController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// ----- user routes
Route::get('/users', [UserController::class, 'index'])
    ->middleware('can:users-show')->name('users.index');
Route::get('users/admins', [UserController::class, 'admins'])
    ->middleware('can:admins-show')->name('users.index.admins');
Route::get('/users/blocked', [UserController::class, 'blockedUsers'])
    ->middleware('can:blockedUser-show')->name('users.index.blocked');
Route::get('/users/{user}', [UserController::class, 'show'])
    ->middleware('can:users-show')->name('users.show');
Route::get('/users/edit/{user}', [UserController::class, 'edit'])
    ->middleware('can:users-edit')->name('users.edit');
Route::patch('/users/edit/{user}', [UserController::class, 'update'])
    ->middleware('can:users-edit')->name('users.update');
Route::post('/users/block', [UserController::class, 'block'])
    ->middleware('can:users-block')->name('users.block');
Route::post('/users/unblock/{user}', [UserController::class, 'unblock'])
    ->middleware('can:users-unblock')->name('users.unblock');
Route::get('/users/premission/{user}', [UserPremissionController::class, 'create'])
    ->middleware('can:users-premission')->name('users.premission.create');
Route::post('/users/premission/{user}', [UserPremissionController::class, 'store'])
    ->middleware('can:users-premission')->name('users.premission.store');
Route::get('/users/downloads/{user}', [UserDownloadController::class, 'index'])
    ->middleware('can:users-show')->name('users.downloads.index');
// -----/user routes

// -----Role Routes
Route::get('/roles', [RoleController::class, 'index'])
    ->middleware('can:roles-show')->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])
    ->middleware('can:roles-create')->name('roles.create');
Route::post('/roles/create', [RoleController::class, 'store'])
    ->middleware('can:roles-create')->name('roles.store');
Route::get('/roles/edit/{role:name}', [RoleController::class, 'edit'])
    ->middleware('can:roles-edit')->name('roles.edit');
Route::patch('/roles/edit/{role:name}', [RoleController::class, 'update'])
    ->middleware('can:roles-edit')->name('roles.update');
Route::delete('/roles/delete', [RoleController::class, 'destroy'])
    ->middleware('can:roles-delete')->name('roles.destroy');
// -----/Role Routes

// -----Course Routes
Route::get('/courses', [CourseController::class, 'index'])
    ->middleware('can:courses-show')->name('courses.index');
Route::get('/courses/image', [CourseController::class, 'image'])
    ->middleware('can:courses-show')->name('courses.image');
Route::get('/courses/create', [CourseController::class, 'create'])
    ->middleware('can:courses-create')->name('courses.create');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])
    ->middleware('can:users-show')->name('courses.show');
Route::post('/courses/create', [CourseController::class, 'store'])
    ->middleware('can:courses-create')->name('courses.store');
Route::get('/courses/edit/{course:slug}', [CourseController::class, 'edit'])
    ->middleware('can:courses-edit')->name('courses.edit');
Route::patch('/courses/edit/{course:slug}', [CourseController::class, 'update'])
    ->middleware('can:courses-edit')->name('courses.update');
Route::delete('/courses/delete', [CourseController::class, 'destroy'])
    ->middleware('can:courses-delete')->name('courses.destroy');
// -----/Course Routes

// -----Episode Routes
Route::get('/{course:slug}/episodes', [EpisodeController::class, 'index'])
    ->middleware('can:courses-show')->name('episodes.index');
Route::get('/{course:slug}/episodes/create', [EpisodeController::class, 'create'])
    ->middleware('can:courses-create')->name('episodes.create');
Route::get('/{course:slug}/episodes/{episode}', [EpisodeController::class, 'show'])
    ->middleware('can:courses-show')->name('episodes.show');
Route::post('/{course:slug}/episodes/create', [EpisodeController::class, 'store'])
    ->middleware('can:courses-create')->name('episodes.store');
Route::get('/{course:slug}/episodes/edit/{episode}', [EpisodeController::class, 'edit'])
    ->middleware('can:courses-edit')->name('episodes.edit');
Route::patch('/{course:slug}/episodes/edit/{episode}', [EpisodeController::class, 'update'])
    ->middleware('can:courses-edit')->name('episodes.update');
Route::delete('/{course:slug}/episodes/delete', [EpisodeController::class, 'destroy'])
    ->middleware('can:courses-delete')->name('episodes.destroy');
// -----/Episode Routes

// -----Discount Routes
Route::get('/discounts', [DiscountController::class, 'index'])
    ->middleware('can:discounts-show')->name('discounts.index');
Route::get('/discounts/create', [DiscountController::class, 'create'])
    ->middleware('can:discounts-create')->name('discounts.create');
Route::post('/discounts/create', [DiscountController::class, 'store'])
    ->middleware('can:discounts-create')->name('discounts.store');
Route::get('/discounts/edit/{discount}', [DiscountController::class, 'edit'])
    ->middleware('can:discounts-edit')->name('discounts.edit');
Route::patch('/discounts/edit/{discount}', [DiscountController::class, 'update'])
    ->middleware('can:discounts-edit')->name('discounts.update');
Route::delete('/discounts/delete', [DiscountController::class, 'destroy'])
    ->middleware('can:discounts-delete')->name('discounts.destroy');
// -----/Discount Routes

// -----articles Routes
Route::get('/articles', [ArticleController::class, 'index'])
    ->middleware('can:articles-show')->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])
    ->middleware('can:articles-create')->name('articles.create');
Route::post('/articles/create', [ArticleController::class, 'store'])
    ->middleware('can:articles-create')->name('articles.store');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])
    ->middleware('can:articles-show')->name('articles.show');
Route::get('/articles/edit/{article:slug}', [ArticleController::class, 'edit'])
    ->middleware('can:articles-edit')->name('articles.edit');
Route::patch('/articles/edit/{article:slug}', [ArticleController::class, 'update'])
    ->middleware('can:articles-edit')->name('articles.update');
Route::delete('/articles/delete', [ArticleController::class, 'destroy'])
    ->middleware('can:articles-delete')->name('articles.destroy');
// -----/articles Routes


// -----comments Routes
Route::middleware('can:comments-manage')->group(function(){
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/all', [CommentController::class, 'all'])->name('comments.all');
    Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comments.show');
    Route::post('/comments/create', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/apply', [CommentController::class, 'apply'])->name('comments.apply');
    Route::post('/comments/chose', [CommentController::class, 'chose'])->name('comments.chose');
    Route::delete('/comments/delete', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// -----/comments Routes

// -----tickets Routes
Route::middleware('can:tickets-manage')->group(function(){
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/all', [TicketController::class, 'all'])->name('tickets.all');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');
});

// -----/tickets Routes

Route::get('load-charts',function(){
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

        return redirect()->back();
    }
});