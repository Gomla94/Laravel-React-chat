<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\InterestingType;
use App\Models\Post;
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
        
        return view('profile', [
            'user' => $user,
            'areas_of_interesting' => $areas_of_interesting,
            'countries' => $countries,
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
