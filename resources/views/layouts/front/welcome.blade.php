@extends('layouts.front.welcome-app')
@section('meta-description')
<meta name="description" content="this is the main page of magaxat.com">
@endsection
@section('content')

<div class="appeals-section">
  <div class="main-appeals-title-wrapper">
    <p class="main-appeals-title">Who need help now</p>
  </div>
  <div class="swiper appealsSwiper">
    <div class="swiper-wrapper appeals-wrapper">
      @foreach($random_appeals as $appeal)
        <div class="swiper-slide appeal-slide">
          <div class="appeal-slide-image-wrapper">
            <img class="appeal-slide-image" src="{{ $appeal->image_path }}" alt="" />
          </div>
          <div class="appeal-slider-info-wrapper">
            <p class="appeal-title">{{ $appeal->title }}</p>
            <p class="appeal-description">
              {{ str_limit($appeal->description, 100) }}
            </p>
          </div>
          <a href="{{ route('show-appeal', $appeal->uniqueid) }}" class="appeal-slide-link">See more</a>
        </div>
      @endforeach
    </div>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>

<div class="main-posts-wrapper">
  <div class="main-posts-title-wrapper">
    <p class="main-posts-title">News line</p>
  </div>
  <div class="main-posts-buttons-wrapper">
    <div class="main-posts-search-wrapper">
      <form action="{{ route('welcome', request()->query()) }}" method="GET">
        {{-- @csrf --}}
        <i class="fas fa-search main-posts-search-icon"></i>
        <input
          type="text"
          name="search-key"
          placeholder="Search"
          class="main-posts-search-input"
        />
        <button class="search-button">Search</button>
      </form>
    </div>
    <div class="main-posts-add-buttons">
      <button class="main-posts-add-appeal-button">Request for help</button>
      <button class="main-posts-add-post-button">
        <i class="fal fa-plus new-post-icon"></i>
        New post
      </button>
    </div>
  </div>

  <div class="main-posts-container">
    <div class="main-posts">
      @foreach($random_posts as $post)
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
          <p class="post-description">
            {{ $post->description }}
          </p>
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

@endsection
@push('js')

<script>
 window.uuxyz.uuxyzc = <?php echo json_encode($user_country); ?>
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="{{ asset('js/addPostLike.js') }}" defer type="module"></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
<script src="{{ asset('js/loadPosts.js?version=7') }}" defer type="module"></script>
<script src="{{asset('js/newest-addPostComments.js')}}" defer type="module"></script>

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
