@extends('layouts.front.app')
@section('content')
<div class="profile-container">
        <div class="profile-image-wrapper">
            <img class="profile-image" src="{{ asset($user->image ?? 'images/avatar.png') }}" />
        </div>
        <form class="profile-form" action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="profile-form-group">
                <label class="create-post-label" for="image">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            @error('image')
            <span class="error-span">{{$message}}</span>
            @enderror
            <div class="profile-form-group">
                <label class="create-post-label" for="age">Age</label>
                <input type="number" min="0" class="form-control" value="{{ $user->age }}" name="age">
            </div>
            @error('age')
            <span class="error-span">{{$message}}</span>
            @enderror
            <div class="profile-form-group">
                <label class="create-post-label" for="date_of_birth">Date Of Birth</label>
                <input type="date" class="form-control" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}" name="date_of_birth">
            </div>
            @error('date_of_birth')
            <span class="error-span">{{$message}}</span>
            @enderror
            <div class="profile-form-group">
                <label class="create-post-label" for="area_of_interest">Area Of Interesting</label>
                <select class="select-form-control" name="area_of_interest" id="area_of_interest">
                    <option selected disabled>Select A Type</option>
                    @foreach($areas_of_interesting as $area)
                    <option value="{{ $area->id }}" {{ $user->interesting_type_id === $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('area_of_interest')
            <span class="error-span">{{$message}}</span>
            @enderror
      
            <button type="submit" class="btn btn-primary update-profile-btn">Update Profile</button>
        </form>

</div>
@endsection