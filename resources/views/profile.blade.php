@extends('layouts.front.app')
@section('css')
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css"
/>
@endsection
@section('content')
{{-- <div class="profile-container">
    <div class="profile-image-wrapper">
        <div class="profile-image-container">
            <img class="profile-image" src="{{ asset($user->image ?? 'images/avatar.png') }}" />
        </div>
    </div>
    <form class="profile-form" action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="create-post-label" for="image">Image</label>
            <input type="file" class="form-control profile-image-input" name="image">
        </div>
        @error('image')
        <span class="error-span">{{$message}}</span>
        @enderror
        
        <div class="form-group">
            <label class="create-post-label" for="date_of_birth">Date Of Birth</label>
            <input type="date" class="form-control" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}" name="date_of_birth">
        </div>
        @error('date_of_birth')
        <span class="error-span">{{$message}}</span>
        @enderror
        <div class="form-group">
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

        <button type="submit" class="btn btn-primary update-profile-button">Update Profile</button>
    </form>
</div> --}}

<div class="container">
  
    <div class="profile-header">
      <div class="profile-img">
        <img class="profile-image" src="{{ asset(auth()->user()->image ?? 'images/avatar.png') }}" width="200" alt="Profile Image">
        <div class="image-demo"></div>

      </div>
      <div class="profile-nav-info">
        <h3 class="user-name">{{ auth()->user()->name }}</h3>
      </div>
    </div>
  
    <div class="main-bd">
      <div class="left-side">
        <div class="profile-side">
          <p class="profile-info"><i class="fa fa-phone profile-info-icon"></i> {{ auth()->user()->phone_number }}</p>
          <p class="profile-info"><i class="fa fa-envelope profile-info-icon"></i> {{ auth()->user()->email }}</p>
          <p class="profile-info"><i class="fas fa-calendar-week profile-info-icon"></i> {{ optional(auth()->user()->date_of_birth)->format('Y-m-d') }}</p>
          <p class="profile-info"><i class="fas fa-venus-mars profile-info-icon"></i> {{ auth()->user()->gender }}</p>
          <p class="profile-info"><i class="fas fa-globe-europe profile-info-icon"></i> {{ optional(auth()->user()->country)->name }}</p>
          <p class="profile-info"> interested in type: {{ auth()->user()->interesting_type->name ?? '' }}</p>
          <p class="profile-info">additional type {{ auth()->user()->additional_type }}</p>
          
        </div>
  
      </div>
      <div class="right-side">
  
        <div class="nav">
          <ul>
            <li onclick="tabs(0)" class="profile-item user-setting"> Settings</li>
          </ul>
        </div>
        <div class="profile-body">
         
          <div class="profile-settings tab">
              <form class="profile-form" action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row profile-row">
                    <div class=" col-md-4">
                        <label class="create-post-label" for="image">Image</label>
                        <input type="file" class="form-control profile-image-input" name="image">
                        @error('image')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="date_of_birth">Date Of Birth</label>
                        <input type="date" class="form-control" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}" name="date_of_birth">
                        @error('date_of_birth')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" value="{{ $user->phone_number }}" name="phone_number">
                        @error('phone_number')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row profile-row">
                    <div class=" col-md-4">
                        <label class="create-post-label" for="gender">Gender</label>
                        <select class="select form-control" name="gender" id="gender">
                            <option selected disabled>Select A Gender</option>
                            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="date_of_birth">Country</label>
                        <select class="select form-control" name="country_id" id="country">
                            <option selected disabled>Select A country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $user->country_id === $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>
                </div>
              
                <div class="col-md-12" >
                    <label class="create-post-label" for="area_of_interest">Area Of Interesting</label>
                    <select class="select form-control" name="area_of_interest" id="area_of_interest">
                        <option selected disabled>Select A Type</option>
                        @foreach($areas_of_interesting as $area)
                        <option value="{{ $area->id }}" {{ $user->interesting_type_id === $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area_of_interest')
                    <span class="profile-error-span">{{$message}}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary update-profile-button">Update Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('js')
  <script src="{{ asset('js/profilePage.js') }}" defer></script>
  
  <script src="{{ asset('js/cropProfilePage.js') }}" defer></script>
  @endpush
@endsection