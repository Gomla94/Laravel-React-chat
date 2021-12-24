<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppealsRequest;
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

    public function store(AddAppealsRequest $request)
    {
        $user = Auth::user();
        
        $attributes = validator(request()->all(), [
            'post_title' => ['required', 'string'],
            'post_description' => ['sometimes', 'nullable', 'string'],
            'post_image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'post_video' => ['max:7168', 'mimes:mp4,mov,ogg,qt'],
        ])->validate();

        if (request()->file('appeal_image')) {
            $file = $request->appeal_image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/', $image_name);          
        }
        if (request()->file('appeal_video')) {
            $file = $request->appeal_video;
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/appeals/', $video_name);
        }

        $user->appeals()->create([
            'title' => $attributes['post_title'],
            'description' => $attributes['post_description'],
            'image' => request()->file('appeal_image') ? 'images/appeals/'.$image_name : null,
            'video' => request()->file('appeal_video') ? 'videos/appeals/'.$video_name : null,
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
            'appeal_title' => ['string'],
            'appeal_description' => ['string'],
            'appeal_image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'appeal_video' => ['max:5048'],
        ])->validate();
        
        if (request()->file('appeal_image')) {
            File::delete(public_path($appeal->image));
            $file = $attributes['appeal_image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/', $image_name);
        }
        if (request()->file('appeal_video')) {
            File::delete(public_path($appeal->video));
            $file = $attributes['appeal_video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/appeals/', $video_name);
        }

        $appeal->update([
            'title' => $attributes['appeal_title'],
            'description' => $attributes['appeal_description'],
            'image' => request()->file('appeal_image') ? 'images/appeals/'.$image_name : $appeal->image,
            'video' => request()->file('appeal_video') ? 'videos/appeals/'.$video_name : $appeal->video,
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
