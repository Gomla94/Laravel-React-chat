<?php

namespace App\Http\Controllers;

use App\Events\NewMessageEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index()
    {
        $from = request('from');
        $to = request('to');

        // return response()->json(['to' => $to, 'from' => $from]);
        $chatting_with_user = User::find($to);
        $messages = Message::where([['from', $from], ['to', $to]])
                            ->orWhere([['from', $to], ['to', $from]])
                            ->with('user')->get();
        return response()->json(['messages' => $messages, 'chatting_with_user' => $chatting_with_user]);
    }

    public function top_chat_user()
    {
        $user_id = request('user_id');

        $user = User::where('id', $user_id)->get();
        $users = User::where('id', '!=', $user_id)->get();
        $merged_users = $user->merge($users);
        return $merged_users;
    }

    public function all_users()
    {
        $users = User::where('status', User::ACTIVE_STATUS)
                        ->where('id', '!=', Auth::id())->get();
        return $users;
    }

    public function storeMessage()
    {
        $to = request('to');
        $from = request('from');
        $message = request('message');

        $attributes = validator(request()->all(), [
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
            $file_name = uniqid(). '.' .$extension;
            $file->move('chatmedia/', $file_name);
        }

        $message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $message ?? null,
            'type' => $file_type ?? null,
            'media_path' => request('file') ? 'chatmedia/' . $file_name : null
        ]);

        broadcast(new NewMessageEvent($message->load('user')))->toOthers();

        return response()->json(['message' => $message]);
    }
}
