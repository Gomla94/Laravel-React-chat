<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostCommentRequest;
use App\Http\Requests\AddPostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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

    public function store(AddPostRequest $request)
    {
        $user = Auth::user();

        // $attributes = validator(request()->all(), [
        //     'post_title' => ['required', 'string'],
        //     'post_description' => ['sometimes', 'nullable', 'string'],
        //     'post_image' => ['max:2048', 'mimes:png,jpg,jpeg'],
        //     'post_video' => ['max:7168', 'mimes:mp4,mov,ogg,qt'],
        // ])->validate();
        
        if (request()->file('post_image')) {   
            $file = $request->post_image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/posts/', $image_name);             
        }

        if (request()->file('post_video')) {
            $file = $request->post_video;
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/posts/', $video_name);
        }

        $user->posts()->create([
            'title' => $request->post_title,
            'description' => $request->post_description,
            'image' => request()->file('post_image') ? 'images/posts/'.$image_name : null,
            'video' => request()->file('post_video') ? 'videos/posts/'.$video_name : null,
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
            'post_title' => ['required', 'string'],
            'post_description' => ['sometimes', 'nullable', 'string'],
            'post_image' => ['max:2048', 'mimes:png,jpg,jpeg'],
            'post_video' => ['max:max:7168', 'mimes:mp4,mov,ogg,qt'],
        ])->validate();

        if (request()->file('post_image')) {
            File::delete(public_path($post->image));
            $file = $attributes['post_image'];
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $file->move('images/posts/', $image_name);
        }
        if (request()->file('post_video')) {
            File::delete(public_path($post->video));
            $file = $attributes['post_video'];
            $extension = $file->getClientOriginalExtension();
            $video_name = uniqid(). '.' .$extension;
            $file->move('videos/posts/', $video_name);
        }

        $post->update([
            'title' => $attributes['post_title'],
            'description' => $attributes['post_description'],
            'image' => request()->file('post_image') ? 'images/posts/'.$image_name : $post->image,
            'video' => request()->file('post_video') ? 'videos/posts/'.$video_name : $post->video,
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
    
            $comment = $comment->load('user');
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
