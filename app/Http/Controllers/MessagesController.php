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

        $message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $message
        ]);

        broadcast(new NewMessageEvent($message->load('user')))->toOthers();

        return response()->json(['message' => $message]);
    }
}
