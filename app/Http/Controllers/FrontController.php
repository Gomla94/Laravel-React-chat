<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use App\Models\Country;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function home()
    {
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

    public function load_more_posts()
    {
        $requested_ids = request('ids');
        $more_posts = Post::with(['user', 'comments', 'likes'])->whereNotIn('id', $requested_ids)->limit(5)->get();
        return $more_posts;
    }


    public function all_users()
    {
        $users = User::where('id', '!=', Auth::id())->whereType(User::USER_TYPE)->get();
        // dd($users);
        $filter_keys = array_keys(request()->query());

        // dd($filter_keys);
        foreach($filter_keys as $key) {
            switch ($key) {
                case 'interesting-in-type':
                    $interesting_type = InterestingType::where('name', request('interesting-in-type'))->firstOrFail();
                    $users = $users->where('interesting_type_id', $interesting_type->id);
                    break;

                case 'country':
                    $country = Country::where('name', 'like',request('country'))->firstOrFail();
                    $users = $users->where('country_id', $country->id);
                    break;

                case 'gender':
                    $users = $users->where('gender', request('gender'));
                    break;
                
                default:
                    return $users;
                    break;
            }
        }
        

        $interesting_types = InterestingType::all();
        $countries = Country::all();

        return view('layouts.front.users', [
            'users' => $users,
            'interesting_types' => $interesting_types,
            'countries' => $countries,
        ]);
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
        $appeal_images = $appeal->images()->get();
        return view('layouts.front.show-appeal', [
            'appeal' => $appeal,
            'appeal_images' => $appeal_images
        ]);
    }

    public function show_user_page($user)
    {
        $user = User::find($user);
        $user_posts = $user->posts()->get();
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
            'user_posts' => $user_posts,
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
