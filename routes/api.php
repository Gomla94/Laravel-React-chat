<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::get('/messages', [MessagesController::class, 'index']);
    Route::post('/messages', [MessagesController::class, 'storeMessage']);
    Route::get('/chat-users', [MessagesController::class, 'all_users']);
    Route::get('/top-chat-user', [MessagesController::class, 'top_chat_user']);
    Route::post('/block-user', [MessagesController::class, 'block_user']);
    Route::post('/unblock-user', [MessagesController::class, 'unblock_user']);

     /** notifications */
     Route::get('my_notifications', [UserController::class, 'my_notifications']);
     Route::post('check-notification', [UserController::class, 'check_notification']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
