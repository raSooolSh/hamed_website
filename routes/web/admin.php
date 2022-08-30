<?php

/*
---------------------------------------------------
admin panel routes
---------------------------------------------------
*/

use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// ----- user routes
Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('users/moderators',[UserController::class,'moderators'])->name('user.moderators');
Route::get('/users/blocked',[UserController::class,'blocked'])->name('users.blocked');
Route::get('/users/{user}',[UserController::class,'show'])->name('users.show');
Route::get('/users/edit/{user}',[UserController::class,'edit'])->name('users.edit');
Route::patch('/users/edit/{user}',[UserController::class,'update'])->name('users.update');
Route::post('/users/block',[UserController::class,'block'])->name('users.block');
// -----/user routes
