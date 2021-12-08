<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostCommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserPostsController extends Controller
{
    public function my_posts()
    {
        $my_posts = Auth::user()->posts()->get();
        return view('user.posts.index', ['my_posts' => $my_posts]);
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store()
    {
        $user = Auth::user();
        
        $attributes = validator(request()->all(), [
            'title' => ['required', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'video' => ['max:20168', 'mimes:mp4,mov,ogg,qt'],
        ])->validate();
        
        if (request()->file('image')) {
            $file = $attributes['image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/posts/', $image_name);
        }
        if (request()->file('video')) {
            $file = $attributes['video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/posts/', $video_name);
        }

        $user->posts()->create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'image' => request()->file('image') ? 'images/posts/'.$image_name : null,
            'video' => request()->file('video') ? 'videos/posts/'.$video_name : null,
        ]);

        return back();
    }

    public function edit(Post $post)
    {
        return view('user.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $user = Auth::user();
        
        $attributes = validator(request()->all(), [
            'title' => ['required', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'video' => ['max:20168', 'mimes:mp4,mov,ogg,qt'],
        ])->validate();
        
        if (request()->file('image')) {
            File::delete(public_path($post->image));
            $file = $attributes['image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/posts/', $image_name);
        }
        if (request()->file('video')) {
            File::delete(public_path($post->video));
            $file = $attributes['video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/posts/', $video_name);
        }

        $post->update([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'image' => request()->file('image') ? 'images/posts/'.$image_name : $post->image,
            'video' => request()->file('video') ? 'videos/posts/'.$video_name : $post->video,
        ]);

        return back();
    }

    public function delete(Post $post)
    {
        File::delete(public_path($post->image));
        File::delete(public_path($post->video));
        $post->delete();
        return back();
    }

    public function add_comment(AddPostCommentRequest $request, Post $post)
    {
        try {
            $comment = $post->comments()->create([
                'title' => $request->title,
                'user_id' => Auth::id()
            ]);
    
            return $comment;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    public function add_like($id)
    {
        $post = Post::findOrFail($id);
        $like = $post->likes()->create(['user_id' => Auth::id()]);
        return $like;   
        
    }

    public function delete_like($id)
    {
        $post = Post::findOrFail($id);
        $like = $post->likes()->where('user_id', Auth::id())->delete();
        return $like;   
        
    }


    public function all_comments($id)
    {
        try {
            $post = Post::findOrFail($id);
            $comments = $post->comments()->with('user')->get();
            return $comments;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
       
    }
}
