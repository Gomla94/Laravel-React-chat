<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppealsRequest;
use App\Http\Requests\StoreImageRequest;
use App\Models\Appeal;
use App\Models\Image;
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

        if (request()->file('appeal_image')) {
            $file = $request->appeal_image[0];
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

        $appeal = $user->appeals()->create([
            'title' => $request->appeal_title,
            'description' => $request->appeal_description,
            'image' => request()->file('appeal_image') ? 'images/appeals/'.$image_name : null,
            'video' => request()->file('appeal_video') ? 'videos/appeals/'.$video_name : null,
        ]);

        $other_images = array_except($request->appeal_image, 0);

        foreach($other_images as $image) {
            $file = $image;
            $extension = $file->getClientOriginalExtension();
            $other_image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/appeal_images', $other_image_name); 
            
            $appeal->images()->create([
                'title' => $request->title ?? null,
                'image' => 'images/appeals/appeal_images/'.$other_image_name,
            ]);
        }

        return redirect()->route('user.my_appeals');
    }

    public function edit(Appeal $appeal)
    {
        return view('user.appeals.edit', ['appeal' => $appeal]);
    }

    public function update(Appeal $appeal)
    {

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

    public function appeal_images(Appeal $appeal)
    {
        $appeal_images = $appeal->images()->get();
        return view('user.appeals.images.index', [
            'appeal_images' => $appeal_images,
            'appeal' => $appeal,
        ]);
    }

    public function add_appeal_image(Appeal $appeal)
    {
        return view('user.appeals.images.create', [
            'appeal' => $appeal,
        ]);
    }

    public function store_appeal_image(StoreImageRequest $request, Appeal $appeal)
    {
        if (request()->file('image')) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/appeal_images', $image_name);          
        }

        $appeal->images()->create([
            'title' => $request->title,
            'image' => request()->file('image') ? 'images/appeals/appeal_images/'.$image_name : null,
        ]);

        return redirect()->route('user.appeal.images', $appeal->id);
    }

    public function edit_appeal_image(Appeal $appeal, Image $image)
    {
        return view('user.appeals.images.edit', [
            'appeal' => $appeal,
            'image' => $image,
        ]);
    }

    public function update_appeal_image(StoreImageRequest $request, Appeal $appeal, Image $image)
    {
        if (request()->file('image')) {
            File::delete(public_path($image->image));
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/appeals/appeal_images', $image_name);          
        }

        $image->update([
            'title' => $request->title,
            'image' => request()->file('image') ? 'images/appeals/appeal_images/'.$image_name : null,
        ]);

        return redirect()->route('user.appeal.images', $appeal->id);
    }

    public function delete_appeal_image(Appeal $appeal, Image $image)
    {
        File::delete(public_path($image->image));
        $image->delete();
        return back();
    }
}
