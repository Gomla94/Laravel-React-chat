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
          <p class="profile-info"> @lang('translations.interest_type'): {{ $user->interesting_type->name ?? '' }}</p>
          <p class="profile-info">@lang('translations.add_types'): {{ $user->additional_type }}</p>

        </div>

      </div>
      <div class="right-side">

        <div class="nav">
          <ul>
            @if(Auth::check())
              @if($user->id === auth()->user()->id)
              <li onclick="tabs(0)" class="user-post active profile-item user-setting">@lang('translations.settings')</li>
              @endif
            @endif
            <li onclick="tabs(1)" class="user-review profile-item">@lang('translations.posts')</li>
            <li onclick="tabs(2)" class="user-images profile-item">@lang('translations.images')</li>
            <li onclick="tabs(3)" class="user-videos profile-item">@lang('translations.videos')</li>
            <li onclick="tabs(4)" class="user-videos profile-item">@lang('translations.subscribtions')</li>
            <li onclick="tabs(5)" class="user-setting profile-item">@lang('translations.subscribers')</li>
          </ul>
        </div>
        <div class="profile-body">
          <div class="profile-settings tab">
              <form class="profile-form" action="{{ route('user.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row profile-row">
                    <div class=" col-md-4">
                        <label class="create-post-label" for="image">@lang('translations.images')</label>
                        <input type="file" accept="image/*" class="form-control profile-image-input" name="image">
                        @error('image')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="date_of_birth">@lang('translations.date_of_birth')</label>
                        <input type="date" class="form-control" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}" name="date_of_birth">
                        @error('date_of_birth')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="phone_number">@lang('translations.phone_numb')</label>
                        <input type="text" class="form-control" value="{{ $user->phone_number }}" name="phone_number">
                        @error('phone_number')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="row profile-row">
                    <div class=" col-md-4">
                        <label class="create-post-label" for="gender">@lang('translations.gender')</label>
                        <select class="select form-control" name="gender" id="gender">
                            <option selected disabled>@lang('translations.select_gender')</option>
                            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>@lang('translations.male')</option>
                            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>@lang('translations.female')</option>
                        </select>
                        @error('gender')
                        <span class="profile-error-span">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="create-post-label" for="date_of_birth">@lang('translations.country')</label>
                        <select class="select form-control" name="country_id" id="country">
                            <option selected disabled>@lang('translations.select_country')</option>
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
                    <label class="create-post-label" for="area_of_interest">@lang('translations.interest_area')</label>
                    <select class="select form-control" name="area_of_interest" id="area_of_interest">
                        <option selected disabled>@lang('translations.select_type')</option>
                        @foreach($areas_of_interesting as $area)
                        <option value="{{ $area->id }}" {{ $user->interesting_type_id === $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                    @error('area_of_interest')
                    <span class="profile-error-span">{{$message}}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary update-profile-button">@lang('translations.upd_prof')</button>
            </form>
          </div>
          <div class="profile-posts tab">
            <h1>My Posts</h1>
            <div class="user-posts-wrapper">
              @foreach($my_posts as $post)
              <div class="main-post">
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $post->user->id) }}">
                    <img
                      src="{{asset($post->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <a href="{{ route('user.page', $post->user->id) }}"></a>
                  <div class="main-post-user-names-wrapper">
                    <span class="main-post-user-name">{{ $post->user->name }}</span>
                    <span class="main-post-user-email">{{'@'. $post->user->name }}</span>
                  </div>
                  <span class="post-date">{{ $post->created_at->format('Y-m-d h:i A') }}</span>
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
                        @lang('translations.add_com')
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
            <h1>@lang('translations.my_img')</h1>
            <div class="user-posts-wrapper">
              @foreach($my_posts_images as $image)
              <div class="main-post">
                <div class="main-post-user-info-wrapper">
                  <div class="main-post-user-image-wrapper">
                    <a href="{{ route('user.page', $image->user->id) }}">
                    <img
                      src="{{asset($image->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <a href="{{ route('user.page', $image->user->id) }}"></a>
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
                    <a href="{{ route('user.page', $video->user->id) }}">
                    <img
                      src="{{asset($video->user->image ?? 'images/avatar.png')}}"
                      alt=""
                      class="main-post-user-image"
                    />
                    </a>
                  </div>
                  <a href="{{ route('user.page', $video->user->id) }}"></a>
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
          <div class="profile-posts-subscibtions tab">
            <h1>@lang('translations.subscribtions')</h1>
            <div class="container all-users-list">
              @foreach($my_subscribtions_users as $user)
              <div class="user">
                <a href="{{ route('user.page', $user->id) }}">
                  <div class="user-image-wrapper">
                    <img src="{{ asset($user->image ?? 'images/avatar.png') }}" alt="user-image" />
                  </div>
                </a>
                <div class="users-social">
                  <span class="user-social-span">{{ $user->name }}</span>
                  <span class="user-social-span">{{ $user->email }}</span>
                  {{-- <span class="user-social-span">Открыть полный профиль</span> --}}
                </div>
                {{-- @if(Auth::check())
                  <div class="user-subscription-button">
                    <div class="user-green-message-box" data-id={{ $user->id }}>
                      <i class="fas fa-envelope user-envelope" data-id={{ $user->id }}></i>
                    </div>
                    @if($user->subscribed($user->id))
                    <form action="{{ route('unsubscribe', $user->id) }}" method="POST">
                      @csrf
                      <button class="fas fa-check checkmark-icon"></button>
                    </form>
                    @else
                    <form action="{{ route('subscribe', $user->id) }}" method="POST">
                      @csrf
                      <button class="user-subscribe">
                        subscribe
                      </button>
                    </form>
                    @endif
                  </div>
                @endif --}}
              </div>
              @endforeach
            </div>
          </div>
          <div class="profile-posts-subscribers tab">
            <h1>@lang('translations.subscribers')</h1>
            <div class="container all-users-list">
              @foreach($my_subscribers as $user)
              <div class="user">
                <a href="{{ route('user.page', $user->id) }}">
                  <div class="user-image-wrapper">
                    <img src="{{ asset($user->image ?? 'images/avatar.png') }}" alt="user-image" />
                  </div>
                </a>
                <div class="users-social">
                  <span class="user-social-span">{{ $user->name }}</span>
                  <span class="user-social-span">{{ $user->email }}</span>
                  {{-- <span class="user-social-span">Открыть полный профиль</span> --}}
                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  @push('js')
  <script src="{{ asset('js/profilePage.js') }}" defer></script>
  <script src="{{ asset('js/cropProfilePage.js') }}" defer></script>
  <script src="{{ asset('js/addPostComment.js') }}" defer type="module"></script>
  <script src="{{ asset('js/addPostLike.js') }}" defer type="module"></script>
  @endpush
@endsection
