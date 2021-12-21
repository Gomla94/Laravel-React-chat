<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function home()
    {
        // $post = Post::findOrFail(5);
        // // dd($post->likes);
        // dd($post->likes->where('user_id', Auth::id()));

        $user = Auth::user();
        if ($user) {
            $user->update(['api_token' => str_random(60)]);
        }
        $random_users = User::whereType(User::USER_TYPE)->inRandomOrder()->limit(10)->get();
        $random_appeals = Appeal::with('user')->inRandomOrder()->limit(12)->get();
        $random_posts = Post::with(['user', 'comments', 'likes'])->inRandomOrder()->limit(5)->get();
        return view('layouts.front.welcome', [
            'random_users' => $random_users,
            'random_appeals' => $random_appeals,
            'random_posts' => $random_posts,
        ]);
    }


    public function all_users()
    {
        $users = User::where('id', '!=', Auth::id())->whereType(User::USER_TYPE)->get();
        return view('layouts.front.users', ['users' => $users]);
    }

    public function all_benefactors()
    {
        $benefactors = User::where('id', '!=', Auth::id())->whereType(User::BENEFACTOR_TYPE)->paginate(3);
        return view('layouts.front.benefactors', ['benefactors' => $benefactors]);
    }

    public function all_appeals()
    {
        $appeals = Appeal::with('user')->paginate(20);
        return view('layouts.front.appeals', ['appeals' => $appeals]);
    }

    public function show_appeal(Appeal $appeal)
    {
        $appeal = $appeal->with('user')->firstOrFail();
        return view('layouts.front.show-appeal', ['appeal' => $appeal]);
    }

    public function show_user_page($user)
    {
        $user = User::find($user);
        $user_posts_count = $user->posts->count();
        $user_images_count = $user->posts->whereNotNull('image')->count();
        $user_videos_count = $user->posts->whereNotNull('video')->count();
        $interesting_type = InterestingType::find($user->interesting_type_id);
        return view('layouts.front.user-details', [
            'user' => $user, 
            'interesting_type' => $interesting_type,
            'user_posts_count' => $user_posts_count,
            'user_images_count' => $user_images_count,
            'user_videos_count' => $user_videos_count,
        ]);
    }

    public function show_videos_page()
    {
        $posts_with_videos = Post::whereNotNull('video')->with('user')->get();
        return view('layouts.front.videos', ['videos' => $posts_with_videos]);
    }

    public function show_video_page($id)
    {   $post = Post::whereNotNull('video')->whereId($id)->with('user')->firstOrFail();
        $other_videos = Post::whereNotNull('video')->where('id', '!=', $id)->with('user')->get();
        return view('layouts.front.video-details', [
            'video' => $post,
            'other_videos' => $other_videos
        ]);
    }

    public function subscribe(User $user)
    {
        auth()->user()->subscribtions()->create(['user_id' => $user->id]);
        return back();
    }

    public function unsubscribe(User $user)
    {
        $subscribtion = auth()->user()->subscribtions()->where('user_id', $user->id)->firstOrFail();
        $subscribtion->delete();
        return back();
    }
}
