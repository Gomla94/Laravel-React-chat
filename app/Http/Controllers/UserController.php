<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function update_profile_image()
    {
        $attributes = validator(request()->all(), [
            // 'image' => ['max:2048', 'mimes:png,jpg,jpeg']
            'image' => ['required']
        ])->validate();

        $user = Auth::user();

        if (request()->file('image')) {
            File::delete(public_path($user->image));
            $file = $attributes['image'];
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/users/', $image_name);
            $user->update(['image' => 'images/users/'.$image_name]);
        }

        return redirect()->route('user.profile');
    }

    

}
