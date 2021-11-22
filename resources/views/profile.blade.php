@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                <div>
                    <p>Name: <strong>{{$user->name}}</strong></p>
                </div>
                image: <img src="{{ $user->image ? asset($user->image) : asset('/images/avatar.png') }}" width="100px" height="100px" />
                <hr/>
                <h5>Update Image</h5>
                <form action="{{ route('user.update-profile-image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            {{$message}}
                        @enderror
                    </div>

                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection