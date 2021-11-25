<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
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
}
