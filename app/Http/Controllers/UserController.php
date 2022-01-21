<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        $user_interesting_types_ids = $user->interesting_type_id !== "null" ? json_decode($user->interesting_type_id) : [];
        $my_interesting_types = $user_interesting_types_ids !== null ? InterestingType::whereIn('id', $user_interesting_types_ids)->get() : null;
        $user = $user->load('country');
        $areas_of_interesting = InterestingType::all();
        $countries = Country::all();
        $my_posts = $user->posts()->get();
        $my_appeals = $user->appeals()->get();
        $my_posts_images = $user->posts()->whereNull('video')->whereNotNull('image')->get();
        $my_posts_videos = $user->posts()->whereNull('image')->whereNotNull('video')->get();
        $my_subscribtions = $user->subscribtions()->pluck('user_id');
        $my_subscribtions_users = User::whereIn('id', $my_subscribtions)->get();
        $my_subscribers = $user->subscribers()->pluck('subscriber_id');
        $my_subscribers_users = User::whereIn('id', $my_subscribers)->get();
        $user_subscribers_count = $user->subscribers()->count();
        $user_subscribtions_count = $user->subscribtions()->count();

        return view('profile', [
            'user' => $user,
            'my_interesting_types' => $my_interesting_types,
            'countries' => $countries,
            'areas_of_interesting' => $areas_of_interesting,
            'my_posts' => $my_posts,
            'my_appeals' => $my_appeals,
            'my_posts_images' => $my_posts_images,
            'my_posts_videos' => $my_posts_videos,
            'my_subscribtions_users' => $my_subscribtions_users,
            'my_subscribers_users' => $my_subscribers_users,
            'my_subscribers' => $my_subscribers_users,
            'user_subscribers_count' => $user_subscribers_count,
            'user_subscribtions_count' => $user_subscribtions_count,
            'user_interesting_types_ids' => $user_interesting_types_ids
        ]);
    }


    public function update_profile()
    {
        $attributes = validator(request()->all(), [
            'image' => ['sometimes','nullable','max:2048', 'mimes:png,jpg,jpeg'],
            'date_of_birth' => ['sometimes','nullable','date'],
            'phone_number' => ['sometimes','nullable','numeric'],
            'interesting_type' => ['sometimes', 'nullable', 'array'],
            'interesting_type.*' => ['numeric', Rule::exists('interesting_types', 'id')],
            'country_id' => ['sometimes','nullable','integer', Rule::exists('countries', 'id')],
            'gender' => ['sometimes','nullable','string', Rule::in('male', 'female')]
        ])->validate();

        $user = Auth::user();
        $user->update([
            'date_of_birth' => $attributes['date_of_birth'],
            'phone_number' => $attributes['phone_number'],
            'gender' => $attributes['gender'] ?? null,
            'country_id' => $attributes['country_id'] ?? null,
            'interesting_type_id' => json_encode(request('interesting_type'))?? null,
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

    public function my_notifications()
    {
        $user = Auth::user();
        $my_notifications = $user->notifications()->where('type', 'App\Notifications\NewSubscribtion')
                            ->where('read_at', null)->get();
        return $my_notifications;
    }

    public function check_notification()
    {
        try {
            $notification_id = request('nid');
            $status = request('status');
            $user_notification = auth()->user()->notifications()->where('id', $notification_id)->firstOrFail();
            if ($status === 'accept') {
                $user = User::where('email', $user_notification->data['user_email'])->first();
                auth()->user()->subscribtions()->create(['user_id' => $user->unique_id]);
            }
            $user_notification->update(['read_at' => now()]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    public function get_notification_user()
    {
        $notification_id = request('nid');
        $notification_data = DB::table('notifications')->where('id', $notification_id)->pluck('data')->first();
        $notification_data = json_decode($notification_data);
        $notification_user = User::where('email', $notification_data->user_email)->first();
        return $notification_user;
    }

}
