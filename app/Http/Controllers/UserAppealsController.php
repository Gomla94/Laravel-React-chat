<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserAppealsController extends Controller
{
    public function my_appeals()
    {
        $my_appeals = Auth::user()->appeals()->get();
        return view('user.appeals.index', ['my_appeals' => $my_appeals]);
    }

    public function create()
    {
        return view('user.appeals.create');
    }

    public function store()
    {
        $user = Auth::user();
        
        $attributes = validator(request()->all(), [
            'title' => ['string'],
            'description' => ['string'],
            'image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'video' => ['max:5048'],
        ])->validate();
        
        if (request()->file('image')) {
            $file = $attributes['image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/', $image_name);
        }
        if (request()->file('video')) {
            $file = $attributes['video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/appeals/', $video_name);
        }

        $user->appeals()->create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'image' => request()->file('image') ? 'images/appeals/'.$image_name : null,
            'video' => request()->file('video') ? 'videos/appeals/'.$video_name : null,
        ]);

        return redirect()->route('user.my_appeals');
    }

    public function edit(Appeal $appeal)
    {
        return view('user.appeals.edit', ['appeal' => $appeal]);
    }

    public function update(Appeal $appeal)
    {
        $user = Auth::user();
        
        $attributes = validator(request()->all(), [
            'title' => ['string'],
            'description' => ['string'],
            'image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'video' => ['max:5048'],
        ])->validate();
        
        if (request()->file('image')) {
            File::delete(public_path($appeal->image));
            $file = $attributes['image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/', $image_name);
        }
        if (request()->file('video')) {
            File::delete(public_path($appeal->video));
            $file = $attributes['video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/appeals/', $video_name);
        }

        $appeal->update([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'image' => request()->file('image') ? 'images/appeals/'.$image_name : $appeal->image,
            'video' => request()->file('video') ? 'videos/appeals/'.$video_name : $appeal->video,
        ]);

        return redirect()->route('user.my_appeals');
    }

    public function delete(Appeal $appeal)
    {
        File::delete(public_path($appeal->image));
        File::delete(public_path($appeal->video));
        $appeal->delete();
        return back();
    }
}
