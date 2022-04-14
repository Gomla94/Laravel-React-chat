<?php

namespace App\Http\Controllers;

use App\Events\NewSubscribtionEvent;
use App\Models\Appeal;
use App\Models\Country;
use App\Models\Image;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use App\Notifications\NewSubscribtion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Omnipay\Omnipay;
use Share;

class FrontController extends Controller
{


    public function home()
    {
        $user = Auth::user();
        if ($user) {
            $user->update(['api_token' => str_random(60)]);
            return redirect()->route('user.chat');
        }
            return redirect()->route('login');

    }


    public function all_users()
    {
        $filter_keys = array_keys(request()->query());

        $users = User::where('id', '!=', Auth::id())->whereType(User::USER_TYPE)->get();
        foreach($filter_keys as $key) {
            switch ($key) {
                case 'user-name':
                    $request_name = request('user-name');
                    $users = $users->filter(function($item, $key) use($request_name) {
                        return $item->name == ucfirst($request_name);
                    });
                    break ;
                
                    default:
                        break;
            }
        }


        return view('layouts.front.users', [
            'users' => $users,
        ]);
    }


    public function subscribe($uniquid)
    {
        $user = User::where('unique_id', $uniquid)->firstOrFail();
        auth()->user()->subscribtions()->create(['user_id' => $user->unique_id]);
        return back();
    }

    public function unsubscribe($uniquid)
    {
        $user = User::where('unique_id', $uniquid)->firstOrFail();
        $subscribtion = auth()->user()->subscribtions()->where('user_id', $user->unique_id)->firstOrFail();
        $subscribtion->delete();
        return back();
    }

    public function chat()
    {
        return view('layouts.front.chat');
    }
}
