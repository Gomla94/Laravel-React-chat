<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'home'])->name('welcome');
Route::get('/all-users',[FrontController::class, 'all_users'])->name('all-users');
Route::post('/subscribe/{id}',[FrontController::class, 'subscribe'])->name('subscribe');
Route::post('/unsubscribe/{id}',[FrontController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth', 'as' => 'user.'], function() {
    Route::get('chat', [FrontController::class, 'chat'])->name('chat');
});

Auth::routes();



