<?php

namespace App\Http\Controllers;

use App\Events\BlockUserEvent;
use App\Events\NewMessageEvent;
use App\Events\UnblockUserEvent;
use App\Models\ChatBlock;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessagesController extends Controller
{
    public function index()
    {
        $from = base64_decode(request('from'));
        $to = base64_decode(request('to'));
        
        $chatting_with_user = User::where('unique_id', $to)->first();
       
        $messages = Message::where([['from', $from], ['to', $to]])
                            ->orWhere([['from', $to], ['to', $from]])
                            ->with('user')->get();
        return response()->json([
            'messages' => $messages,
            'chatting_with_user' => $chatting_with_user,
        ]);
    }

    public function top_chat_user()
    {
        $user_uniqueid = request('nid');
        $user = User::where('unique_id', $user_uniqueid)->first();
        $user_subscriptions_ids = Auth::user()->subscribtions()->get()->pluck('user_id');
        $user_subscriptions = User::where('unique_id', '!=', $user_uniqueid)
        ->whereIn('unique_id', $user_subscriptions_ids)->get();
        $user_subscriptions->prepend($user);
        return $user_subscriptions;
    }

    public function all_users()
    {
        $user = Auth::user();
        $user_subscriptions_ids = $user->subscribtions()->get()->pluck('user_id');
        $user_subscriptions = User::whereIn('unique_id', $user_subscriptions_ids)
                            ->with('messages', function($query) use($user) {
                                $query->where('to', $user->unique_id)->orderBy('id', 'desc')->limit(1);
                            })->get();
        return $user_subscriptions;
    }

    public function storeMessage()
    {
        $to = request('to');
        $from = Auth::user()->unique_id;
        $message = request('message');

        $attributes = validator(request()->all(), [
            'message' => ['string'],
            'file' => ['sometimes', 'nullable', 'max:2048', 'mimes:png,jpg,jpeg,mp4,mov,ogg,qt', 'max:2048'],
        ])->validate();
        
        
        if (request()->file('file')) {
            $file = $attributes['file'];
            $extension = $file->getClientOriginalExtension();
            $image_extensions = ['png', 'jpg', 'jpeg'];
            if(in_array($extension, $image_extensions)) {
                $file_type = 'image';
            } else {
                $file_type = 'video';
            }
           
            $file_path = request()->file('file')->store('images', 's3');

        }

        $sent_message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $message ?? null,
            'type' => $file_type ?? null,
            'media_path' => request('file') ? Storage::disk('s3')->url($file_path) : null
        ]);

        broadcast(new NewMessageEvent($sent_message->load('user')))->toOthers();

        return response()->json(['sent_message' => $sent_message]);
    }

}
