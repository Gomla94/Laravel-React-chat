@extends('layouts.front.app')
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
      </div>
      <div class="profile-nav-info">
        <h3 class="user-name">{{ auth()->user()->name }}</h3>
        {{-- <div class="address">
          <p id="state" class="state">New York,</p>
          <span id="country" class="country">USA.</span>
        </div> --}}
  
      </div>
      {{-- <div class="profile-option">
        <div class="notification">
          <i class="fa fa-bell"></i>
          <span class="alert-message">3</span>
        </div>
      </div> --}}
    </div>
  
    <div class="main-bd">
      <div class="left-side">
        <div class="profile-side">
          <p class="profile-info"><i class="fa fa-phone profile-info-icon"></i> {{ auth()->user()->phone_number }}</p>
          <p class="profile-info"><i class="fa fa-envelope profile-info-icon"></i> {{ auth()->user()->email }}</p>
          <p class="profile-info"><i class="fas fa-calendar-week profile-info-icon"></i> {{ auth()->user()->date_of_birth->format('Y-m-d') }}</p>
          <p class="profile-info"> interested in type: {{ auth()->user()->interesting_type->name ?? '' }}</p>
          <p class="profile-info">additional type {{ auth()->user()->additional_type }}</p>
          {{-- <div class="user-bio">
            <h3>Bio</h3>
            <p class="bio">
              Lorem ipsum dolor sit amet, hello how consectetur adipisicing elit. Sint consectetur provident magni yohoho consequuntur, voluptatibus ghdfff exercitationem at quis similique. Optio, amet!
            </p>
          </div> --}}
          {{-- <div class="profile-btn">
            <button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>
            <button class="createbtn" id="Create-post"><i class="fa fa-plus"></i> Create</button>
          </div>
          <div class="user-rating">
            <h3 class="rating">4.5</h3>
            <div class="rate">
              <div class="star-outer">
                <div class="star-inner">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              </div>
              <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
            </div>
  
          </div> --}}
        </div>
  
      </div>
      <div class="right-side">
  
        <div class="nav">
          <ul>
            <li onclick="tabs(0)" class="profile-item user-setting"> Settings</li>
          </ul>
        </div>
        <div class="profile-body">
          {{-- <div class="profile-posts tab">
            <h1>Your Post</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa quia sunt itaque ut libero cupiditate ullam qui velit laborum placeat doloribus, non tempore nisi ratione error rem minima ducimus. Accusamus adipisci quasi at itaque repellat sed
              magni eius magnam repellendus. Quidem inventore repudiandae sunt odit. Aliquid facilis fugiat earum ex officia eveniet, nisi, similique ad ullam repudiandae molestias aspernatur qui autem, nam? Cupiditate ut quasi iste, eos perspiciatis maiores
              molestiae.</p>
          </div>
          <div class="profile-reviews tab">
            <h1>User reviews</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam pariatur officia, aperiam quidem quasi, tenetur molestiae. Architecto mollitia laborum possimus iste esse. Perferendis tempora consectetur, quae qui nihil voluptas. Maiores debitis
              repellendus excepturi quisquam temporibus quam nobis voluptatem, reiciendis distinctio deserunt vitae! Maxime provident, distinctio animi commodi nemo, eveniet fugit porro quos nesciunt quidem a, corporis nisi dolorum minus sit eaque error
              sequi ullam. Quidem ut fugiat, praesentium velit aliquam!</p>
          </div> --}}
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
  @endpush
@endsection