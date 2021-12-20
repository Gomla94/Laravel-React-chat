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

class MessagesController extends Controller
{
    public function index()
    {
        $from = base64_decode(request('from'));
        $to = base64_decode(request('to'));
        
        
        // return response()->json(['to' => $to, 'from' => $from]);
        $chatting_with_user = User::find($to);
        // $user_is_blocked = (bool)auth()->user()->chat_blocks()
        //                     ->where([ ['blocker_id', $from], ['user_id', $to] ])
        //                     ->orWhere([ ['user_id' , $from], ['blocker_id', $to] ])->count();

        $blocked_this_user = auth()->user()->chat_blocks()
                                ->where('user_id', $to)->first();

        $blocked_by_this_user = ChatBlock::where('blocker_id', $to)
                                            ->where('user_id', auth()->user()->id)->first();


        $messages = Message::where([['from', $from], ['to', $to]])
                            ->orWhere([['from', $to], ['to', $from]])
                            ->with('user')->get();
        return response()->json([
            'messages' => $messages,
            'chatting_with_user' => $chatting_with_user,
            'blocked_this_user' => $blocked_this_user,
            'blocked_by_this_user' => $blocked_by_this_user
        ]);
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

        $sent_message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $message ?? null,
            'type' => $file_type ?? null,
            'media_path' => request('file') ? 'chatmedia/' . $file_name : null
        ]);

        broadcast(new NewMessageEvent($sent_message->load('user')))->toOthers();

        return response()->json(['sent_message' => $sent_message]);
    }

    public function block_user()
    {
        $blockedUser = request('blockedUser');
        $chat_block_status = auth()->user()->chat_blocks()->create(['user_id' => $blockedUser]);
        broadcast(new BlockUserEvent($chat_block_status->load('user')))->toOthers();
        return $chat_block_status;
    }

    public function unblock_user()
    {
        $unblockedUser = request('unblockedUser');
        $chat_unblock = auth()->user()->chat_blocks()
        ->where('user_id', $unblockedUser)->firstOrFail();

        $if_i_still_blocked_the_user = (bool)ChatBlock::where('blocker_id', $unblockedUser)
                                            ->where('user_id', auth()->user()->id)->count();

        broadcast(new UnblockUserEvent($chat_unblock->load('user'), $if_i_still_blocked_the_user))->toOthers();
        $chat_unblock->delete();
        return response()->json(['unBlockedUser' => $chat_unblock, 'stillBlocked' => $if_i_still_blocked_the_user]);
    }

    public function check_if_user_is_blocked($user_id)
    {
        $auth_user = auth()->user();
        return $auth_user->has_blocked($user_id);
    }
}
