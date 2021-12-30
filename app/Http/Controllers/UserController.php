<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        $user = $user->load('interesting_type');
        $user = $user->load('country');
        $areas_of_interesting = InterestingType::all();
        $countries = Country::all();
        $my_posts = $user->posts()->get();
        $my_posts_images = $user->posts()->whereNull('video')->whereNotNull('image')->get();
        $my_posts_videos = $user->posts()->whereNull('image')->whereNotNull('video')->get();
        $my_subscribtions = $user->subscribtions()->pluck('user_id');
        $my_subscribtions_users = User::whereIn('id', $my_subscribtions)->get();
        $my_subscribers = $user->subscribers()->pluck('subscriber_id');
        $my_subscribers_users = User::whereIn('id', $my_subscribers)->get();
        // $user_images_count = $user->posts->whereNotNull('image')->count();
        // $user_videos_count = $user->posts->whereNotNull('video')->count();
        $user_subscribers_count = $user->subscribers()->count();
        $user_subscribtions_count = $user->subscribtions()->count();
        
        return view('profile', [
            'user' => $user,
            'areas_of_interesting' => $areas_of_interesting,
            'countries' => $countries,
            'my_posts' => $my_posts,
            'my_posts_images' => $my_posts_images,
            'my_posts_videos' => $my_posts_videos,
            'my_subscribtions_users' => $my_subscribtions_users,
            'my_subscribers_users' => $my_subscribers_users,
            'my_subscribers' => $my_subscribers_users,
            // 'user_videos_count' => $user_videos_count,
            'user_subscribers_count' => $user_subscribers_count,
            'user_subscribtions_count' => $user_subscribtions_count,
        ]);
    }


    public function update_profile()
    {
        $attributes = validator(request()->all(), [
            'image' => ['sometimes','nullable','max:2048', 'mimes:png,jpg,jpeg'],
            'date_of_birth' => ['sometimes','nullable','date'],
            'phone_number' => ['sometimes','nullable','numeric'],
            'area_of_interest' => ['sometimes','nullable','integer', Rule::exists('interesting_types', 'id')],
            'country_id' => ['sometimes','nullable','integer', Rule::exists('countries', 'id')],
            'gender' => ['sometimes','nullable','string', Rule::in('male', 'female')]
        ])->validate();

        $user = Auth::user();

        // if (request()->file('image')) {
        //     File::delete(public_path($user->image));
        //     $file = $attributes['image'];
        //     $extension = $file->getClientOriginalExtension();
        //     $image_name = uniqid(). '.' .$extension;
        //     $file->move('images/users/', $image_name);
        // }

        $user->update([
            // 'image' => request('image') ? 'images/users/'.$image_name : null,
            'date_of_birth' => $attributes['date_of_birth'],
            'phone_number' => $attributes['phone_number'],
            'gender' => $attributes['gender'] ?? null,
            'country_id' => $attributes['country_id'] ?? null,
            'interesting_type_id' => request('area_of_interest') ? $attributes['area_of_interest'] : null
        ]);

        return redirect()->route('user.profile');
    }

    public function update_profile_image()
    {
        $cropped_image = request('croppedImage');
        $image_array = explode(";", $cropped_image);
        $image_array_2 = explode(",", $image_array[1]);
        $data = base64_decode($image_array_2[1]);
        File::delete(auth()->user()->image);
        $image_name = 'images/users/'.time(). '.' .'png';
        
        file_put_contents(public_path($image_name), $data);
        auth()->user()->update(['image' => $image_name]);
    }

}
