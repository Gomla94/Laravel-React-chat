<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $random_users = User::whereType(User::USER_TYPE)->inRandomOrder()->limit(10)->get();
        $random_appeals = Appeal::with('user')->inRandomOrder()->limit(4)->get();
        $random_posts = Post::with('user')->inRandomOrder()->limit(4)->get();
        return view('layouts.front.welcome', [
            'random_users' => $random_users,
            'random_appeals' => $random_appeals,
            'random_posts' => $random_posts,
        ]);
    }


    public function all_users()
    {
        $users = User::whereType(User::USER_TYPE)->get();
        return view('layouts.front.users', ['users' => $users]);
    }

    public function show_user_page($user)
    {
        $user = User::find($user);
        $interesting_type = InterestingType::find($user->interesting_type_id);
        return view('layouts.front.user-details', ['user' => $user, 'interesting_type' => $interesting_type]);
    }
}
