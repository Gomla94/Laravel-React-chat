<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppealsController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserAppealsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontController::class, 'home']);
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
Route::put('update-profile-image', [UserController::class, 'update_profile_image'])->name('user.update-profile-image');

/* Facebook Login Routes**/
Route::get('/auth/facebook/', [FacebookController::class, 'FacebookLogin'])->name('facebook.login');
Route::get('/auth/facebook/redirect', [FacebookController::class, 'callback']);

/* Instagram Login Routes**/
Route::get('/auth/instagram/', [InstagramController::class, 'InstagramLogin'])->name('instagram.login');
Route::get('/auth/instagram/redirect', [InstagramController::class, 'callback']);

Route::group(['middleware' => 'auth', 'as' => 'user.'], function() {
    /** user posts routes */
    Route::get('my-posts', [UserPostsController::class, 'my_posts'])->name('my_posts');
    Route::get('my-posts/create', [UserPostsController::class, 'create'])->name('posts.create');
    Route::post('my-posts/create', [UserPostsController::class, 'store'])->name('posts.store');
    Route::get('my-posts/{post}/edit', [UserPostsController::class, 'edit'])->name('posts.edit');
    Route::put('my-posts/{post}/edit', [UserPostsController::class, 'update'])->name('posts.update');
    Route::delete('my-posts/{post}/delete', [UserPostsController::class, 'delete'])->name('posts.delete');
    
    /** user appeals routes */
    Route::get('my-appeals', [UserAppealsController::class, 'my_appeals'])->name('my_appeals');
    Route::get('my-appeals/create', [UserAppealsController::class, 'create'])->name('appeals.create');
    Route::post('my-appeals/create', [UserAppealsController::class, 'store'])->name('appeals.store');
    Route::get('my-appeals/{appeal}/edit', [UserAppealsController::class, 'edit'])->name('appeals.edit');
    Route::put('my-appeals/{appeal}/edit', [UserAppealsController::class, 'update'])->name('appeals.update');
    Route::delete('my-appeals/{appeal}/delete', [UserAppealsController::class, 'delete'])->name('appeals.delete');
});

/** Users */
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function() {
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::delete('users/{user}', [AdminController::class, 'delete_user'])->name('users.delete');
    Route::put('users/{user}/block', [AdminController::class, 'block_user'])->name('users.block');
    Route::put('users/{user}/unblock', [AdminController::class, 'unblock_user'])->name('users.unblock');
    Route::get('/users/create', [AdminController::class, 'create_user'])->name('users.create');
    Route::post('/users', [AdminController::class, 'store_user'])->name('users.store');
});
