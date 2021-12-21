<?php

namespace App\Http\Controllers;

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
        $areas_of_interesting = InterestingType::all();
        return view('profile', [
            'user' => $user,
            'areas_of_interesting' => $areas_of_interesting
        ]);
    }


    public function update_profile()
    {
        $attributes = validator(request()->all(), [
            'image' => ['sometimes','nullable','max:2048', 'mimes:png,jpg,jpeg'],
            'age' => ['sometimes','nullable','integer'],
            'date_of_birth' => ['sometimes','nullable','date'],
            'area_of_interest' => ['sometimes','nullable','integer', Rule::exists('interesting_types', 'id')]
        ])->validate();

        $user = Auth::user();

        if (request()->file('image')) {
            File::delete(public_path($user->image));
            $file = $attributes['image'];
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/users/', $image_name);
        }

        $user->update([
            'image' => request('image') ? 'images/users/'.$image_name : null,
            'age' => $attributes['age'],
            'date_of_birth' => $attributes['date_of_birth'],
            'area_of_interest' => request('area_of_interest') ? $attributes['area_of_interest'] : null
        ]);

        return redirect()->route('user.profile');
    }

}
