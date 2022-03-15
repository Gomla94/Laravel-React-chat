@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the user {{ $user->name }} profile page">
@endsection
@section('title')
Magaxat | Profile
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
@endsection
@section('content')


<div class="profile-wrapper">
  <div class="container">
    <div class="profile-container">
      <div class="profile-header">
        <div class="profile-img">
          <img class="profile-image" src="{{ $user->image ?? asset('images/avatar.png') }}" width="200" alt="Profile Image" />
          <div id="upload-input" style="width:350px; height: 400px;"></div>

          <div class="change-profile-image-icon">
            <label for="profile-image-input" class="profile-image-label">
              <i class="fa-solid fa-camera"></i>
              <input
                type="file"
                class="profile-image-input"
                name=""
                id="profile-image-input"
              />
              <span>Change</span>
            </label>
          </div>
        </div>
      </div>

      <div class="main-bd">
        <div class="left-side">
          <div class="profile-side">
            <p class="profile-user-name">{{ $user->name }}</p>
            <p class="profile-icon-wrapper">
              <i class="fa fa-phone"></i> <span>{{ $user->phone_number }}</span>
            </p>
            <p class="profile-icon-wrapper">
              <i class="fa fa-envelope"></i>
              <span>{{ $user->email }}</span>
            </p>
          </div>
        </div>
        <div class="right-side">
          <div class="nav">
            <ul>
              <li onclick="tabs(0)" class="profile-item user-settings">
                Settings
              </li>
              <li onclick="tabs(1)" class="profile-item user-review">
                Posts
              </li>
              <li onclick="tabs(2)" class="profile-item user-appeals">
                Appeals
              </li>
              <li onclick="tabs(3)" class="profile-item user-images">
                Images
              </li>
              <li onclick="tabs(4)" class="profile-item user-appeals">
                Videos
              </li>
              <li onclick="tabs(5)" class="profile-item user-subscribers">
                Subscribers
              </li>
              <li onclick="tabs(6)" class="profile-item user-subscribtions">
                Subscribtions
              </li>
            </ul>
          </div>
          <div class="profile-body">
            <div class="profile-settings tab">
              <h1>Settings</h1>
              
              <div class="profile-main-settings">
               <form action="{{ route('user.update-profile') }}" method="POST" class="profile-form">
                 @csrf
                 @method('PUT')
                <div class="row mb-3">
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="first_name">First Name</label>
                      </div>
                      <input class="form-control" type="text" name="name" placeholder="first name" value="{{ $user->name }}">
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="email">Email</label>
                      </div>
                      <input class="form-control" id="email" type="text" name="email" placeholder="email" value="{{ $user->email }}">
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="date_of_birth">Date Of Birth</label>
                      </div>
                      <input class="form-control" id="date_of_birth" type="date" name="date_of_birth" value="{{ optional($user->date_of_birth)->format('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="country">Country</label>  
                      </div>
                      <select class="form-control" name="country_id" id="country">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="last_name">Last Name</label>
                      </div>
                      <input class="form-control" id="last_name" type="text" name="last_name" placeholder="last name" value="{{ $user->last_name }}">
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="phone_number">Phone Number</label>
                      </div>
                      <input class="form-control" id="phone_number" type="text" name="phone_number" placeholder="phone number" value="{{ $user->phone_number }}">
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="gender">Gender</label>
                      </div>
                      <select name="gender" id="gender" class="form-control">
                        <option value="male" {{ $user->gender === 'male' ? 'selected' : ''}}>Male</option>
                        <option value="female" {{ $user->gender === 'female' ? 'selected' : ''}}>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="">
                    <div class="form-group">
                      <div>
                        <label for="additional_type">Additional Type</label>
                      </div>
                      <select class="form-control" name="additional_type" id="additional_type">
                          <option value="individual">Individual</option>
                          <option value="organisation">Organisation</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="">
                  <div class="col-md-12">
                    <div class="">
                      <div>
                        <label for="area_of_interest">Area Of Interesting</label>
                      </div>
                      <div class="profile-areas">
                        @foreach($areas_of_interesting as $area)
                        <div class="mb-2 mr-2">
                          <div class="area-check">
                            <label for="{{ $area->name }}">{{ $area->name }}</label>
                            @if($user_interesting_types_ids !== null)
                              <div class="round">
                                <input name="interesting_type[]" type="checkbox" id="{{ $area->name }}" {{ in_array( $area->id, $user_interesting_types_ids ) ? 'checked' : '' }} value="{{ $area->id }}"> 
                                <label for="{{ $area->name }}"></label>
                              </div>
                            @else
                            <div class="round">
                              <input name="interesting_type[]" type="checkbox" id="{{ $area->name }}" value="{{ $area->id }}"> 
                              <label for="{{ $area->name }}"></label>
                            </div>
                            @endif
                            
                          </div>
                        </div>
                        @endforeach
                      </div>
                      
                    </div>
                  </div>
                </div>

                <button class="update-profile-button" type="submit">Update</button>
               </form>
              </div>
            </div>
            <div class="profile-posts tab">
              <h1>Posts</h1>
              <div class="profile-create-posts-wrapper">
                <div class="profile-create-posts-icon-wrapper">
                  <i class="fa-solid fa-plus profile-add-post-button"></i>
                </div>
                <p>Creat a Post</p>
              </div>
              @foreach($my_posts as $post)
              <div class="main-post">
                <div class="post-user-date-wrapper">
                  <div class="post-user-info">
                    <div class="post-user-image-wrapper">
                      <img src="{{ $post->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </div>
                    <div class="post-user-names-wrapper">
                      <span class="post-user-name">{{ $post->user->name }}</span>
                      <span class="post-user-link">@ {{ $post->user->name }}</span>
                    </div>
                  </div>
                  <div class="post-date-wrapper">
                    <span class="post-date">{{ $post->created_at->format('Y-m-d') }}</span>
                    <span class="post-time">{{ $post->created_at->format('H:i:a') }}</span>
                  </div>
                </div>
                <p class="post-title">
                  {{ $post->title }}
                </p>
                @if($post->image_path)
                <div class="post-image-wrapper">
                  <img
                    class="main-post-image"
                    src="{{ $post->image_path }}"
                    alt="post-image"
                  />
                </div>
                @endif
      
                @if($post->video_path)
                <div class="post-image-wrapper">
                  <video controls
                    class="main-post-image"
                    src="{{ $post->video_path }}"
                    alt="post-image"
                  /></video>
                </div>
                @endif
                {{-- <p class="post-description">
                  {{ $post->description }}
                </p> --}}
                <div class="main-post-socials-wrapper">
                  <div class="likes-count">
                    {{-- <i class="fa-solid fa-heart social-icon"></i> --}}
      
                  @if(Auth::check())
                  <i
                    id="{{ $post->id }}"
                    class="social-icon post-heart-icon fa-solid {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart ' }}"
                  ></i>
                  @else
                  <i
                    class="social-icon fa-solid fa-heart"
                  ></i>
                  @endif
      
      
      
                    <span>{{ $post->likes->count() }}</span>
                  </div>
                  <div class="comments-count" id="{{ $post->id }}">
                    <i id="{{ $post->id }}"
                      class="fa-regular fa-comment social-icon main-post-comments-icon"
                    ></i>
                    <span>{{ $post->comments->count() }}</span>
                  </div>
                  <div class="shares-count">
                    <i class="fa-solid fa-share social-icon"></i>
                    <span>4</span>
                  </div>
                </div>
      
                <div class="main-post-comment-form-wrapper">
                  @if (Auth::check())
                  <form class="main-post-comment-form">
                    <div class="form-group">
                      <textarea
                        name="title"
                        class="form-control main-post-form-textarea"
                        id="{{ $post->id }}"
                        cols="10"
                        rows="2"
                      ></textarea>
                    </div>
                    <div class="comment-error-div">
                      <span class="comment-error-span"></span>
                    </div>
                    <button type="button" class="main-post-add-comment-btn">
                      Add comment
                    </button>
                  </form>
                  @endif
                </div>
      
                <div class="main-post-comments-section">
                  
                </div>
              </div>
              @endforeach
            </div>
            <div class="profile-appeals tab">
              <h1>Appeals</h1>
              <div class="profile-create-appeals-wrapper">
                <div class="profile-create-posts-icon-wrapper">
                  <i class="fa-solid fa-plus profile-add-appeal-button"></i>
                </div>
                <p>Creat Appeal</p>
              </div>
              @foreach($my_appeals as $appeal)
              <div class="main-post">
                <div class="post-user-date-wrapper">
                  <div class="post-user-info">
                    <div class="post-user-image-wrapper">
                      <img src="{{ $appeal->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </div>
                    <div class="post-user-names-wrapper">
                      <span class="post-user-name">{{ $appeal->user->name }}</span>
                      <span class="post-user-link">@ {{ $appeal->user->name }}</span>
                    </div>
                  </div>
                  <div class="post-date-wrapper">
                    <span class="post-date">{{ $appeal->created_at->format('Y-m-d') }}</span>
                    <span class="post-time">{{ $appeal->created_at->format('H:i:a') }}</span>
                  </div>
                </div>
                <p class="post-title">
                  {{ $post->appeal }}
                </p>
                @if($appeal->image_path)
                <div class="post-image-wrapper">
                  <img
                    class="main-post-image"
                    src="{{ $appeal->image_path }}"
                    alt="post-image"
                  />
                </div>
                @endif
      
                @if($appeal->video_path)
                <div class="post-image-wrapper">
                  <video controls
                    class="main-post-image"
                    src="{{ $post->video_path }}"
                    alt="post-image"
                  /></video>
                </div>
                @endif
                <p class="post-description">
                  {{ $appeal->description }}
                </p>
                
              </div>
              @endforeach
            </div>
            <div class="profile-images tab">
              <h1>Images</h1>
              @foreach($my_posts_images as $image)
              <div class="main-post">
                <div class="post-user-date-wrapper">
                  <div class="post-user-info">
                    <div class="post-user-image-wrapper">
                      <img src="{{ $image->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </div>
                    <div class="post-user-names-wrapper">
                      <span class="post-user-name">{{ $image->user->name }}</span>
                      <span class="post-user-link">@ {{ $image->user->name }}</span>
                    </div>
                  </div>
                  <div class="post-date-wrapper">
                    <span class="post-date">{{ $image->created_at->format('Y-m-d') }}</span>
                    <span class="post-time">{{ $image->created_at->format('H:i:a') }}</span>
                  </div>
                </div>
                
                @if($image->image_path)
                <div class="post-image-wrapper">
                  <img
                    class="main-post-image"
                    src="{{ $image->image_path }}"
                    alt="post-image"
                  />
                </div>
                @endif
              </div>
              @endforeach
            </div>
            <div class="profile-videos tab">
              <h1>Videos</h1>
              @foreach($my_videos as $video)
              <div class="main-post">
                <div class="post-user-date-wrapper">
                  <div class="post-user-info">
                    <div class="post-user-image-wrapper">
                      <img src="{{ $video->user->image ?? asset('images/avatar.png') }}" alt="person" />
                    </div>
                    <div class="post-user-names-wrapper">
                      <span class="post-user-name">{{ $video->user->name }}</span>
                      <span class="post-user-link">@ {{ $video->user->name }}</span>
                    </div>
                  </div>
                  <div class="post-date-wrapper">
                    <span class="post-date">{{ $video->created_at->format('Y-m-d') }}</span>
                    <span class="post-time">{{ $video->created_at->format('H:i:a') }}</span>
                  </div>
                </div>
               
                @if($video->video_path)
                <div class="post-image-wrapper">
                  <video controls
                    class="main-post-image"
                    src="{{ $video->video_path }}"
                    alt="post-image"
                  /></video>
                </div>
                @endif
              </div>
              @endforeach
            </div>
            <div class="profile-subscribers tab">
              <h1>Subscribers</h1>
              <div class="users-wrapper">
                <div class="profile-users-container">
                  @foreach($my_subscribers_users as $user)
                    <div class="single-user-wrapper">
                      <div class="profile-single-user-image-wrapper">
                        <a href="{{ route('user.page', $user->unique_id) }}">
                          <img src="{{ $user->image ?? asset('images/avatar.png') }}" alt="user-image" />
                        </a>
                      </div>
                      <div class="single-user-info-wrapper">
                        <div class="single-user-title-desc-container">
                          <span class="single-user-title">{{ $user->name }}</span>
                          <span class="single-user-description">@ {{ $user->name }}</span>
                        </div>
                        <div class="single-user-view-button-wrapper">
                          @if(Auth::check())
                            @if(Auth::user()->subscribed($user->unique_id))
                            <div class="main-video-date-wrapper">
                              <form action="{{ route('unsubscribe', $user->unique_id) }}" method="POST">
                                @csrf
                                <button class="main-video-user-subscribed-link">
                                  <i class="fas fa-check"></i> Subscribed
                                </button>
                              </form>
                            </div>
                            @else
                            <div class="main-video-date-wrapper">
                              <form action="{{ route('subscribe', $user->unique_id) }}" method="POST">
                                @csrf
                                <button class="main-video-user-subscribed-link">
                                  Subscribe
                                </button>
                              </form>
                            </div>
                            @endif
                          @endif
                          {{-- <a href="" class="user-message-link"
                            ><i class="fa-regular fa-comment"></i>Message</a
                          > --}}
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="profile-subscribtions tab">
              <h1>Subscribtions</h1>
              <div class="profile-users-container">
                @foreach($my_subscribtions_users as $user)
                  <div class="single-user-wrapper">
                    <div class="profile-single-user-image-wrapper">
                      <a href="{{ route('user.page', $user->unique_id) }}">
                        <img src="{{ $user->image ?? asset('images/avatar.png') }}" alt="user-image" />
                      </a>
                    </div>
                    <div class="single-user-info-wrapper">
                      <div class="single-user-title-desc-container">
                        <span class="single-user-title">{{ $user->name }}</span>
                        <span class="single-user-description">@ {{ $user->name }}</span>
                      </div>
                      <div class="single-user-view-button-wrapper">
                        @if(Auth::check())
                          @if(Auth::user()->subscribed($user->unique_id))
                          <div class="main-video-date-wrapper">
                            <form action="{{ route('unsubscribe', $user->unique_id) }}" method="POST">
                              @csrf
                              <button class="main-video-user-subscribed-link">
                                <i class="fas fa-check"></i> Subscribed
                              </button>
                            </form>
                          </div>
                          @else
                          <div class="main-video-date-wrapper">
                            <form action="{{ route('subscribe', $user->unique_id) }}" method="POST">
                              @csrf
                              <button class="main-video-user-subscribed-link">
                                Subscribe
                              </button>
                            </form>
                          </div>
                          @endif
                        @endif
                        {{-- <a href="" class="user-message-link"
                          ><i class="fa-regular fa-comment"></i>Message</a
                        > --}}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="posts-modal-wrapper">
  <div class="posts-modal-content">
    <div class="close-modal-container">
      <i class="fa-solid fa-xmark close-posts-modal"></i>
    </div>
    <form
      action="{{ route('user.posts.store') }}"
      class="posts-modal-form"
      method="POST"
      enctype="multipart/form-data"
    >
    @csrf
      <div class="form-group">
        <label class="create-post-label" for="title">Title</label>
        <input
          type="text"
          class="form-control"
          name="post_title"
          placeholder="Title"
        />
        @error('post_title')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label class="create-post-label" for="post_description"
          >Description</label
        >
        <textarea
          name="post_description"
          class="text-area-form-control"
          id="post-description"
          cols="30"
          rows="10"
        ></textarea>
        @error('post_description')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group post-modal-media-container">
        <div class="post-modal-media">
          <label class="create-post-label image-label">Type of media</label>
          <select name="media_type" class="form-control media-type">
            <option value="image">image</option>
            <option value="video">video</option>
          </select>
        </div>
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >Choose your file</label
          >
          <label class="media-label">
            <input
              type="file"
              accept="image/*"
              class="media-input"
              name="post_image"
            />
            <span>Choose File</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('post_image')
            <span style="color: red">{{$message}}</span>
          @enderror
          @error('post_video')
            <span style="color: red">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="form-group post-modal-image-container">
        <label class="create-post-label" for="countries">country</label>
        <select name="country" class="form-control" id="country">
          <option value="">country</option>
        </select>
        @error('post_country')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">
        create post
      </button>
    </form>
  </div>
</div>

<div class="appeals-modal-wrapper">
  <div class="appeals-modal-content">
    <div class="close-modal-container">
      <i class="fa-solid fa-xmark close-appeals-modal"></i>
    </div>
    <form
      action="{{ route('user.appeals.store') }}"
      class="appeals-modal-form"
      method="POST"
      enctype="multipart/form-data"
    >
    @csrf
      <div class="form-group">
        <label class="create-appeal-label" for="title">Title</label>
        <input
          type="text"
          class="form-control"
          name="appeal_title"
          placeholder="Title"
        />
        @error('appeal_title')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group">
        <label class="create-post-label" for="appeal_description"
          >Description</label
        >
        <textarea
          name="appeal_description"
          class="text-area-form-control"
          id="appeal-description"
          cols="30"
          rows="10"
        ></textarea>
        @error('appeal_description')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group post-modal-media-container">
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >Choose Image</label
          >
          <label class="media-label">
            <input
              type="file"
              accept="image/*"
              class="media-input"
              name="appeal_image[]"
              multiple
            />
            <span>Choose Image</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('appeal_image')
            <span style="color: red">{{$message}}</span>
          @enderror
        </div>
        <div class="post-modal-media-type">
          <label class="create-post-label" for="image"
            >Choose Video</label
          >
          <label class="media-label">
            <input
              type="file"
              accept="video/mp4"
              class="media-input"
              name="appeal_video"
            />
            <span>Choose File</span>
            <i class="fa-solid fa-link post-modal-attachement"></i>
          </label>
          @error('appeal_video')
            <span style="color: red">{{$message}}</span>
          @enderror
        </div>
      </div>

      <div class="form-group post-modal-image-container">
        <label class="create-post-label" for="countries">country</label>
        <select name="country" class="form-control" id="country">
          <option value="">country</option>
        </select>
        @error('post_country')
          <span style="color: red">{{$message}}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">
        create appeal
      </button>
    </form>
  </div>
</div>

@push('js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>

<script src="{{ asset('js/profilePage.js') }}" defer></script>
<script src="{{ asset('js/cropProfilePage.js') }}" defer></script>
<script src="{{asset('js/newest-addPostComments.js')}}" defer type="module"></script>
<script src="{{ asset('js/addPostLike.js?version=1') }}" defer type="module"></script>

<script>
  const postsModalContent = document.querySelector('.posts-modal-wrapper');
  const appealsModalContent = document.querySelector('.appeals-modal-wrapper');
  @if ($errors->count() > 0)
  const errors = {!! json_encode($errors->toArray()) !!};
  if(errors['modalType'] == 'postsModal') {
    postsModalContent.style.display="block"
  } else {
    appealsModalContent.style.display="block"
  }
  @endif
</script>
@endpush
@endsection
