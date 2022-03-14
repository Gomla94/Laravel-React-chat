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
use Illuminate\Support\Facades\Validator;
use Omnipay\Omnipay;
use Share;

class FrontController extends Controller
{

    public function payment()
    {
        //
    }

   

    public function home(Request $request)
    {
       
        if(!$sock = @fsockopen('www.google.com', 80))
        {
            $random_posts = Post::with(['user', 'comments', 'likes'])->inRandomOrder()->limit(5)->orderBy('created_at', 'desc')->get();
        }
        else
        {
            $user_ip = $request->ip();
            $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip={$user_ip}"));
            $user_country = $geo['geoplugin_countryName'];

            $posts_with_user_country = Post::with(['user', 'comments', 'likes', 'video'])->where('country', $user_country)->inRandomOrder()->orderBy('created_at', 'desc')->get();

            $posts_without_user_country = Post::with(['user', 'comments', 'likes', 'video'])->where('country', '!=', $user_country)
            ->orWhere('country', null)->inRandomOrder()->limit(2)->orderBy('created_at', 'desc')->get();
            
            $random_posts = $posts_with_user_country->merge($posts_without_user_country);
        }
       
        $user = Auth::user();

        if ($user) {
            $user->update(['api_token' => str_random(60)]);
        }

        

        if(request('search-key')) {
            $random_posts = Post::where('title', 'like', '%'.request('search-key').'%')->with(['user', 'comments', 'likes', 'video'])->inRandomOrder()->limit(5)->orderBy('created_at', 'desc')->get();
        }

        $random_appeals = Appeal::with('user')->inRandomOrder()->limit(12)->get();
        $countries = Country::all();

        $current_url = url()->current();
        $share_links = Share::page($current_url)
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->getRawLinks();

        
        return view('layouts.front.welcome', [
            'random_appeals' => $random_appeals,
            'random_posts' => $random_posts,
            'countries' => $countries,
            'user_country' => $user_country,
            'share_links' => $share_links
        ]);
    }

    public function load_more_posts()
    {
        $requested_ids = request('ids');
        $more_posts = Post::with(['user', 'comments', 'likes', 'video'])->whereNotIn('id', $requested_ids)->limit(5)->orderBy('created_at', 'desc')->get();
        return $more_posts;
    }


    public function all_users()
    {
        $users = User::where('id', '!=', Auth::id())->whereType(User::USER_TYPE)->get();
        $filter_keys = array_keys(request()->query());
        $filtered_users = [];

        foreach($filter_keys as $key) {
            switch ($key) {
                case 'interesting-in-type':
                    $interesting_type = InterestingType::where('name', request('interesting-in-type'))->pluck('id')->firstOrFail();
                    foreach($users as $user) {
                        $user_interesting_types_ids = json_decode($user->interesting_type_id);
                        if ($user_interesting_types_ids !== null) {
                            if (in_array($interesting_type, $user_interesting_types_ids)) {
                                array_push($filtered_users, $user);
                            }
                        }
                        
                    }
                    break;

                case 'country':
                    $country = Country::where('name', 'like',request('country'))->firstOrFail();
                    $users = $users->where('country_id', $country->id);
                    foreach($users as $user) {
                        $filtered_users[] = $user;
                    }
                    break;

                case 'gender':
                    $users = $users->where('gender', request('gender'));
                    foreach($users as $user) {
                        $filtered_users[] = $user;
                    }
                    break;
                
                default:
                    return $filtered_users;
                    break;
            }
        }
        
        $interesting_types = InterestingType::all();
        $countries = Country::all();
        return view('layouts.front.users', [
            'users' => count($filter_keys) !== 0 ? $filtered_users : $users,
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

    public function show_appeal($id)
    {
        $appeal = Appeal::where('uniqueid',$id)->firstOrFail();
        $appeal_images = $appeal->images()->get();
        $current_url = url()->current();
        $share_links = Share::page($current_url)
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->getRawLinks();

        return view('layouts.front.show-appeal', [
            'appeal' => $appeal,
            'appeal_images' => $appeal_images,
            'share_links' => $share_links
        ]);
    }

    public function show_user_page($id)
    {
        $user = User::where('unique_id', $id)->firstOrFail();
        $user_interesting_types_ids = $user->interesting_type_id !== "null" ? json_decode($user->interesting_type_id) : [];
        $my_interesting_types = $user_interesting_types_ids !== null ? InterestingType::whereIn('id', $user_interesting_types_ids)->get() : null;
        $user = $user->load('country');
        $areas_of_interesting = InterestingType::all();
        $countries = Country::all();
        $my_posts = $user->posts()->with('video')->get();
        $my_appeals = $user->appeals()->with('video')->get();
        $my_posts_images = $user->posts()->whereNull('video_path')->get();
        $my_posts_videos = $user->posts()->whereNull('image_path')->get();
        $my_subscribtions = $user->subscribtions()->pluck('user_id');
        $my_subscribtions_users = User::whereIn('id', $my_subscribtions)->get();
        $my_subscribers = $user->subscribers()->pluck('subscriber_id');
        $my_subscribers_users = User::whereIn('id', $my_subscribers)->get();
        $user_subscribers_count = $user->subscribers()->count();
        $user_subscribtions_count = $user->subscribtions()->count();
        
        return view('profile', [
            'user' => $user,
            'areas_of_interesting' => $areas_of_interesting,
            'countries' => $countries,
            'my_posts' => $my_posts,
            'my_appeals' => $my_appeals,
            'my_posts_images' => $my_posts_images,
            'my_posts_videos' => $my_posts_videos,
            'my_subscribtions_users' => $my_subscribtions_users,
            'my_subscribers_users' => $my_subscribers_users,
            'my_subscribers' => $my_subscribers_users,
            'user_subscribers_count' => $user_subscribers_count,
            'user_subscribtions_count' => $user_subscribtions_count,
            'my_interesting_types' => $my_interesting_types,
            'user_interesting_types_ids' => $user_interesting_types_ids,
        ]);
    }

    public function show_videos_page()
    {
        $videos = Video::with('videoable')->get();
        return view('layouts.front.videos', ['videos' => $videos]);
    }

    public function show_video_page($id)
    {   
        $video = Video::where('id', $id)->with('videoable', 'user')->firstOrFail();
        $other_videos = Video::where('id', '!=', $id)->with('videoable', 'user')->get();

        return view('layouts.front.video-details', [
            'video' => $video,
            'other_videos' => $other_videos
        ]);
    }

    public function subscribe($uniquid)
    {
        $user = User::where('unique_id', $uniquid)->firstOrFail();
        $check_if_user_is_subscribed_to_me = (bool)$user->subscribtions()->where('user_id', auth()->user()->unique_id)->first();
        auth()->user()->subscribtions()->create(['user_id' => $user->unique_id]);
        broadcast(new NewSubscribtionEvent($user, Auth::user(), $check_if_user_is_subscribed_to_me))->toOthers();
        return back();
    }

    public function unsubscribe($uniquid)
    {
        $user = User::where('unique_id', $uniquid)->firstOrFail();
        $subscribtion = auth()->user()->subscribtions()->where('user_id', $user->unique_id)->firstOrFail();
        $subscribtion->delete();
        return back();
    }
}
