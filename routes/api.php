<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\Profile\ProfileController;
use App\Http\Controllers\Api\V1\Users\UsersController;
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::get('/messages', [MessagesController::class, 'index']);
    Route::post('/messages', [MessagesController::class, 'storeMessage']);
    Route::get('/chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::post('/block-user', [MessagesController::class, 'block_user']);
    Route::post('/unblock-user', [MessagesController::class, 'unblock_user']);
});

// Application API routes
Route::prefix("v1")->middleware('json.response')->group(function () {
    Route::post("/login",[LoginController::class,'login']);
    Route::post("/register",[RegisterController::class,'register']);


    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout',[LogoutController::class,'logout']);

        // Profile routes
        Route::prefix('profile')->group(function () {
            Route::get('/me',[ProfileController::class,'me']);
            Route::patch('/update',[ProfileController::class,'update']);
        });

        // Post routes
        Route::prefix('posts')->group(function () {
            Route::get('/',[PostController::class,'index']);
            Route::post('/',[PostController::class,'store']);
            Route::get('/{post}',[PostController::class,'find']);
            Route::patch('/{post}',[PostController::class,'update']);
            Route::delete('/{post}',[PostController::class,'remove']);
        });

        // Users routes
        Route::apiResource('users', UsersController::class)->except(['store','update']);
        Route::post('users/changeStatus/{user}', [UsersController::class,'changeStatus']);
    });
});

