@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Edit Appeal: <strong>{{ $appeal->title }}</strong></div>
            <div class="card-body">
               <form action="{{ route('user.appeals.update', $appeal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $appeal->title }}">
                        @error('title')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $appeal->description }}</textarea>
                        @error('description')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <div>
                            <img src="{{ asset($appeal->image) }}" class="mb-3" alt="" width="200px" height="100px">
                        </div>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="video">Video</label>
                        <div>
                            <video src="{{ asset($appeal->video) }}" controls class="mb-3" width="200px" height="100px"></video>
                        </div>
                        <input type="file" class="form-control" name="video">
                        @error('video')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Appeal</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection