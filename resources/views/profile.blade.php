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
        <img class="profile-image" src="{{ asset( $user->image ?? 'images/avatar.png') }}" width="200" alt="Profile Image">
        <div class="image-demo"></div>

      </div>
      <div class="profile-nav-info">
        <h3 class="user-name">{{ $user->name }}</h3>
      </div>
    </div>
  
    <div class="main-bd">
      <div class="left-side">
        <div class="profile-side">
          <p class="profile-info"><i class="fa fa-phone profile-info-icon"></i> {{ $user->phone_number }}</p>
          <p class="profile-info"><i class="fa fa-envelope profile-info-icon"></i> {{ $user->email }}</p>
          <p class="profile-info"><i class="fas fa-calendar-week profile-info-icon"></i> {{ optional($user->date_of_birth)->format('Y-m-d') }}</p>
          <p class="profile-info"><i class="fas fa-venus-mars profile-info-icon"></i> {{ $user->gender }}</p>
          <p class="profile-info"><i class="fas fa-globe-europe profile-info-icon"></i> {{ optional($user->country)->name }}</p>
          <p class="profile-info"> interested in type: 
            {{ $my_interesting_types !== null ? implode(', ', $my_interesting_types->pluck('name')->toArray()) : '' }}
          </p>
          <p class="profile-info">additional type: {{ $user->additional_type }}</p>
          
        </div>
  
      </div>
      <div class="right-side">
  
        <div class="nav">
          <ul>
            @if(Auth::check())
              @if($user->id === auth()->user()->id)
              <li onclick="tabs(0)" class="user-post active profile-item user-setting">Settings</li>
              @endif
            @endif
            <li onclick="tabs(1)" class="user-review profile-item">Posts</li>
            <li onclick="tabs(2)" class="user-images profile-item">Images</li>
            <li onclick="tabs(3)" class="user-videos profile-item">Videos</li>
            <li onclick="tabs(4)" class="user-videos profile-item">Appeals</li>
            <li onclick="tabs(5)" class="user-videos profile-item">Subscribtions</li>
            <li onclick="tabs(6)" class="user-setting profile-item"> Subscribers</li>
          </ul>
        </div>
        <div class="profile-body">
          <div class="profile-settings tab">
            @if(Auth::id() === $user->id)
              <form class="profile-form" action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row profile-row">
                    <div class="col-md-6 mb-5">
                        <label class="create-post-label" for="image">Image</label>
                        <input type="file" accept="image/*" class="form-control profile-image-input" name="image">
                        @error('image')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-5">
                        <label class="create-post-label" for="date_of_birth">Date Of Birth</label>
                        <input type="date" class="form-control" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}" name="date_of_birth">
                        @error('date_of_birth')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-5">
                        <label class="create-post-label" for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" value="{{ $user->phone_number }}" name="phone_number">
                        @error('phone_number')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row profile-row">
                    <div class="col-md-6">
                        <label class="create-post-label" for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option selected disabled>Select A Gender</option>
                            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
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
                    <label class="create-post-label interesting-types-label" for="area_of_interest">Area Of Interesting</label>
                    <div class="interesting-types">
                      @foreach($areas_of_interesting as $area)
                      <div class="checkbox-wrapper">
                        <label for="{{ $area->name }}">{{ $area->name }}</label>
                        @if($user_interesting_types_ids !== null)
                        <input id="{{ $area->name }}" name="interesting_type[]" type="checkbox" value="{{ $area->id }}" {{ in_array( $area->id, $user_interesting_types_ids ) ? 'checked' : '' }}/>
                        @else
                        <input id="{{ $area->name }}" name="interesting_type[]" type="checkbox" value="{{ $area->id }}"/>
                        @endif
                      </div>
                    @endforeach
                    </div>
                    @error('area_of_interest')
                    <span class="profile-error-span">{{$message}}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary update-profile-button">Update Profile</button>
              </form>
            @endif
          </div>
          <div class="profile-posts tab">
            <h1>Posts</h1>
            @if(Auth::id() === $user->id)
              <button class="main-posts-add-post-button profile-add-post-button">
                <i class="fal fa-plus"></i>
                Новый пост
              </button>
            @endif
            <div class="user-posts-wrapper">
              @foreach($my_posts as $post)
              <div class="main-post">
                <div class="delete-post-wrapper">
                  <form action="{{ route('user.posts.delete', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="fas fa-close"></button>
                  </form>
                </div>
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $post->user->unique_id) }}">
                    <img
                      src="{{asset($post->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <div class="main-post-user-names-wrapper">
                    <span class="main-post-user-name">{{ $post->user->name }}</span>
                    <span class="main-post-user-email">{{'@'. $post->user->name }}</span>
                  </div>
                  <span class="post-date">{{ $post->created_at->format('Y-m-d h:iA') }}</spabutton>
                </div>
                <p class="main-post-title">@if($post->title) {{ $post->title }} @endif</p>
                <p class="main-post-description">
                  @if($post->description) {{ str_limit($post->description, 500) }} @endif
                </p>
          
                @if($post->image)
                <div class="main-post-image-wrapper">
                  <img src="{{ asset($post->image) }}" alt="main-post-image" class="main-post-image" />
                </div>
                @endif
                @if($post->video)
                <div class="main-post-video-wrapper">
                  <video
                    controls
                    src="{{ asset($post->video) }}"
                    alt="main-post-video"
                    class="main-post-video"
                  ></video>
                </div>
                @endif
                @if(Auth::check())
                <div class="main-post-comment-form-wrapper">
                  <form class="main-post-comment-form">
                    <div class="form-group">
                      <textarea
                        name="title"
                        class="form-control main-post-form-textarea"
                        id="{{ $post->id }}"
                        cols="30"
                        rows="10"
                      ></textarea>
                    </div>
                    <div class="comment-error-div">
                      <span class="comment-error-span"></span>
                    </div>
                    <button type="button" class="main-post-comment-button">
                      Add Comment
                    </button>
                  </form>
                </div>
                @endif
                <div class="main-post-socials">
                  <div class="main-post-likes">
                    <span>{{ $post->likes->count() }}</span>
                    @if(Auth::check())
                    <i
                      id="{{ $post->id }}"
                      class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }} post-heart-icon"
                    ></i>
                    @else
                    <i
                      id="{{ $post->id }}"
                      class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }}"
                    ></i>
                    @endif
                  </div>
                  <div class="main-post-comments">
                    <span class="comments-count-span">{{ $post->comments->count() }}</span>
                    <i
                      class="far fa-comments main-post-comments-icon"
                      id="{{ $post->id }}"
                    ></i>
                  </div>
                </div>
                <div class="main-post-comments-section"></div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-posts-images tab">
            <h1>My Images</h1>
            <div class="user-posts-wrapper">
              @foreach($my_posts_images as $image)
              <div class="main-post">
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $image->user->unique_id) }}">
                      <img
                      src="{{asset($image->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <div class="main-post-user-names-wrapper">
                    <span class="main-post-user-name">{{ $image->user->name }}</span>
                    <span class="main-post-user-email">{{'@'. $image->user->name }}</span>
                  </div>
                  <span class="post-date">{{ $image->created_at->format('Y-m-d h:i A') }}</span>
                </div>
                <div class="main-post-image-wrapper">
                  <img src="{{ asset($image->image) }}" alt="main-post-image" class="main-post-image" />
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-posts-videos tab">
            <h1>Videos</h1>
            <div class="user-posts-wrapper">
              @foreach($my_posts_videos as $video)
              <div class="main-post">
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $video->user->unique_id) }}">
                    <img
                      src="{{asset($video->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <div class="main-post-user-names-wrapper">
                    <span class="main-post-user-name">{{ $video->user->name }}</span>
                    <span class="main-post-user-email">{{'@'. $video->user->name }}</span>
                  </div>
                  <span class="post-date">{{ $video->created_at->format('Y-m-d h:i A') }}</span>
                </div>
                <div class="main-post-video-wrapper">
                  <video
                    controls
                    src="{{ asset($video->video) }}"
                    alt="main-post-video"
                    class="main-post-video"
                  ></video>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-appeals tab">
            <h1>Appeals</h1>
            @if(Auth::id() === $user->id)
              <button class="main-posts-add-appeal-button profile-add-post-button">запрос о помощи</button>
            @endif
            <div class="user-posts-wrapper">
              @foreach($my_appeals as $appeal)
              <div class="main-post">
                <div class="delete-post-wrapper">
                  <form action="{{ route('user.appeals.delete', $appeal->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="fas fa-close"></button>
                  </form>
                </div>
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $appeal->user->unique_id) }}">
                    <img
                      src="{{asset($appeal->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <a href="{{ route('user.page', $appeal->user->unique_id) }}"></a>
                  <div class="main-post-user-names-wrapper">
                    <span class="main-post-user-name">{{ $appeal->user->name }}</span>
                    <span class="main-post-user-email">{{'@'. $appeal->user->name }}</span>
                  </div>
                  <span class="post-date">{{ $appeal->created_at->format('Y-m-d h:i A') }}</span>
                </div>
                <p class="main-post-title">@if($appeal->title) {{ $appeal->title }} @endif</p>
                <p class="main-post-description">
                  @if($appeal->description) {{ str_limit($appeal->description, 500) }} @endif
                </p>
          
                @if($appeal->image)
                <div class="main-post-image-wrapper">
                  <img src="{{ asset($appeal->image) }}" alt="main-post-image" class="main-post-image" />
                </div>
                @endif
                @if($appeal->video)
                <div class="main-post-video-wrapper">
                  <video
                    controls
                    src="{{ asset($appeal->video) }}"
                    alt="main-post-video"
                    class="main-post-video"
                  ></video>
                </div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-posts-subscibtions tab">
            <h1>Subscribtions</h1>
            <div class="container all-users-list">
              @foreach($my_subscribtions_users as $subscribtion_user)
              <div class="user">
                <a href="{{ route('user.page', $subscribtion_user->id) }}">
                  <div class="user-image-wrapper">
                    <img src="{{ asset($subscribtion_user->image ?? 'images/avatar.png') }}" alt="user-image" />
                  </div>
                </a>
                <div class="users-social">
                  <span class="user-social-span">{{ $subscribtion_user->name }}</span>
                  <span class="user-social-span">{{ $subscribtion_user->email }}</span>
                  {{-- <span class="user-social-span">Открыть полный профиль</span> --}}
                </div>
                @if(Auth::check() && auth()->user()->id !== $subscribtion_user->id)
                  <div class="user-subscription-button">
                    <div class="user-green-message-box" data-id={{ $subscribtion_user->id }}>
                      <i class="fas fa-envelope user-envelope" data-id={{ $subscribtion_user->id }}></i>
                    </div>
                  </div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-posts-subscribers tab">
            <h1>Subscribers</h1>
            <div class="container all-users-list">
              @foreach($my_subscribers as $subscriber_user)
              <div class="user">
                <a href="{{ route('user.page', $subscriber_user->id) }}">
                  <div class="user-image-wrapper">
                    <img src="{{ asset($subscriber_user->image ?? 'images/avatar.png') }}" alt="user-image" />
                  </div>
                </a>
                <div class="users-social">
                  <span class="user-social-span">{{ $subscriber_user->name }}</span>
                  <span class="user-social-span">{{ $subscriber_user->email }}</span>
                </div>
                @if(Auth::check() && auth()->user()->id !== $subscriber_user->id)
                  <div class="user-subscription-button">
                    <div class="user-green-message-box" data-id={{ $subscriber_user->id }}>
                      <i class="fas fa-envelope user-envelope" data-id={{ $subscriber_user->id }}></i>
                    </div>
                  </div>
                @endif
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- add post modal -->
<div class="posts-modal-wrapper">
  <div class="modal-content">
    <div class="close-modal-container">
      <span class="close-posts-modal">&times;</span>
    </div>
    <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label class="create-post-label" for="title">Title</label>
          <input type="text" class="form-control" name="post_title" placeholder="Title">
          @error('post_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="post_description">Description</label>
          <textarea name="post_description" class="text-area-form-control" id="description" cols="30" rows="10"></textarea>
          @error('post_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      
      <div class="form-group modal-checker-container">
        <div class="post-modal-checker">
          <div class="modal-checker"></div>
        </div>
        <label class="create-post-label image-label">Image</label>
        <label class="create-post-label video-label">Video</label>
        @error('post_image')
          <span style="color:red">{{$message}}</span>
        @enderror
        @error('post_video')
          <span style="color:red">{{$message}}</span>
        @enderror
      </div>
      

      <div class="form-group post-modal-image-container">
          <label class="create-post-label" for="image">Image</label>
          <input type="file" accept="image/*" class="form-control" name="post_image">
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">Create Post</button>
  </form>
  </div>
</div>


 <!-- add appeal modal -->
 <div class="appeals-modal-wrapper">
  <div class="modal-content">
    <div class="close-modal-container">
      <span class="close-appeals-modal">&times;</span>
    </div>
    <form action="{{ route('user.appeals.store', Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label class="create-post-label" for="title">Title</label>
          <input type="text" class="form-control" name="appeal_title" value="{{ old('appeal_title') }}" placeholder="Title">
          @error('appeal_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="description">Description</label>
          <textarea name="appeal_description" class="text-area-form-control" id="description" cols="30" rows="10">{{ old('appeal_description') }}</textarea>
          @error('appeal_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-image-container">
          <label class="create-post-label" for="image">Image</label>
          <input type="file" accept="image/*" multiple class="form-control" name="appeal_image[]">
          @if($errors->has('appeal_image.*'))
            @foreach($errors->get('appeal_image.*') as $error)
            @foreach($error as $err)
              <p style="color:red">{{$err}}</p>
            @endforeach
            @endforeach
          @endif
      </div>

      <div class="form-group modal-image-container">
        <label class="create-post-label" for="video">Video</label>
        <input type="file" accept="video/*" class="form-control" name="appeal_video">
        @error('appeal_video')
          <span style="color:red">{{$message}}</span>
        @enderror
    </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">Create Appeal</button>
  </form>
  </div>
</div>

  @push('js')
  <script src="{{ asset('js/profilePage.js') }}" defer></script>
  <script src="{{ asset('js/cropProfilePage.js') }}" defer></script>
  <script src="{{ asset('js/addPostComment.js') }}" defer type="module"></script>
  <script src="{{ asset('js/addPostLike.js') }}" defer type="module"></script>
  @endpush
@endsection