<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
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
    Route::post("/login",[\App\Http\Controllers\Api\V1\Auth\LoginController::class,'login']);
    Route::post("/register",[\App\Http\Controllers\Api\V1\Auth\RegisterController::class,'register']);


    // Authenticated routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me',function (){
            return \App\Http\Resources\User\UserResource::make(auth()->user())->hide([
                'updated_at','created_at'
            ]);
        });

        Route::post('/logout',[\App\Http\Controllers\Api\V1\Auth\LogoutController::class,'logout']);

        Route::prefix('posts')->group(function () {
            Route::get('/',[\App\Http\Controllers\Api\V1\Post\PostController::class,'index']);
            Route::post('/',[\App\Http\Controllers\Api\V1\Post\PostController::class,'store']);
        });
    });
});

