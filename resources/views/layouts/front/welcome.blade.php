@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the main page of magaxat.com">
@endsection
@section('content')

@if(auth()->user() == null)
<div class="container-fluid brief">
  <div class="brief-container">
    <div class="brief-image-wrapper">
      <div class="brief-image-container">
        <div class="brief-image-text">
          <span class="brief-image-title">@lang("translations.social_site")</span>
          <span class="brief-image-site">MAGAXAT.COM</span>
        </div>
        <img class="brief-image" alt="brief-image" src="{{asset('images/toppng 1.png')}}" />
      </div>
    </div>
    <div class="brief-info-wrapper">
      <div class="brief-info-container">
        <p class="brief-title">
          @lang("translations.site_description")
        </p>
        <div class="brief-links">
          <div class="brief-phone-mail">
            <i class="fas fa-envelope"></i>
            <span
              ><a class="email-span" href="mailto:info@magaxat.com"
                >info@magaxat.com</a
              ></span
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<div class="help-section">
  <div class="help-section-title">@lang("translations.need_help_now")</div>
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      @foreach($random_appeals as $appeal)
      <div class="swiper-slide">
        <div class="appeal-card">
            <a rel="preconnect" href="{{ route('show-appeal', $appeal->id) }}">
            <div class="appeal-card-image-wrapper">
              @if($appeal->image_path)
              <img src="{{ asset($appeal->image_path) }}" alt="appeal-image" class="appeal-card-image" />
              @endif
            </div>
            <div class="appeal-card-title">
              <p>{{str_limit($appeal->title, 40)}}</p>
              </div>
            <div class="appeal-card-description">
              <p>{{str_limit($appeal->description, 50)}}</p>
            </div>
            <a rel="preconnect" href="{{ route('show-appeal', $appeal->id) }}" class="appeal-card-button">@lang("translations.want_help")</a>
          </a>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="main-posts">
  <div class="main-posts-buttons-container">
    <p class="main-posts-title">@lang("translations.news")</p>
    @if(Auth::check())
    <div class="main-posts-buttons-wrapper">
      <div class="main-posts-search-wrapper">
        <form action="{{ route('welcome', request()->query()) }}" method="GET">
          <i class="fas fa-search main-posts-search-icon"></i>
          <input type="text" name="search-key" class="main-posts-search-input" />
          <button class="search-button">@lang('translations.search')</button>
        </form>
      </div>
      <div class="main-posts-add-buttons">
        <button class="main-posts-add-appeal-button">@lang("translations.help_request")</button>
        <button class="main-posts-add-post-button">
          <i class="fal fa-plus"></i>
          @lang("translations.new_post")
        </button>
      </div>
    </div>
    @endif
  </div>
  <div class="posts-wrapper">
    @foreach($random_posts as $post)
      <div class="main-post" data-id="{{ $post->id }}">
        <div class="main-post-user-info-wrapper">
          <div class="main-post-user-image-wrapper">
            <a rel="preconnect" href="{{ route('user.page', $post->user->unique_id) }}">
            <img
              src="{{asset($post->user->image ?? 'images/avatar.png')}}"
              alt="user-image"
              class="main-post-user-image"
            />
            </a>
          </div>
          <a rel="preconnect" href="{{ route('user.page', $post->user->unique_id) }}">
            <div class="main-post-user-names-wrapper">
              <span class="main-post-user-name">
                {{ $post->user->name }}
              </span>
              <span class="main-post-user-email">{{'@'. $post->user->name }}</span>
            </div>
          </a>
          <span class="post-date">{{ $post->created_at->format('Y-m-d h:i A') }}</span>
        </div>
        <p class="main-post-title">@if($post->title) {{ $post->title }} @endif</p>
        <p class="main-post-description">
          @if($post->description) {{ str_limit($post->description, 500) }} @endif
        </p>

        @if($post->image_path)
        <div class="main-post-image-wrapper">
          <img src="{{ asset($post->image_path) }}" alt="main-post-image" class="main-post-image" />
        </div>
        @endif @if($post->video_path)
        <div class="main-post-video-wrapper">
          <video
            controls
            src="{{ asset($post->video_path) }}"
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
              @lang("translations.add_comment")
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
          @if(Auth::check())
            @if($post->user_id !== Auth::id())
            <div class="main-post-share">
              <form action="{{ route('post.share', $post->id) }}" method="POST">
                @csrf
                <button class="fa-solid fa-share share-btn"></button>
              </form>
            </div>
            @endif
          @endif
        </div>
        <div class="main-post-comments-section"></div>
      </div>
    @endforeach
    {{-- <div class="more-posts-loader"></div> --}}
  </div>
</div>

<!-- add post modal -->
<div class="posts-modal-wrapper">
  <div class="posts-modal-content">
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
          <label class="create-post-label" for="post_description">@lang("translations.description")</label>
          <textarea name="post_description" class="text-area-form-control" id="post-description" cols="30" rows="10"></textarea>
          @error('post_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-checker-container">
        <label class="create-post-label image-label">@lang("translations.image")</label>
        <div class="post-modal-checker">
          <div class="modal-checker"></div>
        </div>
        <label class="create-post-label video-label">@lang("translations.video")</label>
        @error('post_image')
          <span style="color:red">{{$message}}</span>
        @enderror
        @error('post_video')
          <span style="color:red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group post-modal-image-container">
          <label class="create-post-label" for="image">@lang("translations.image")</label>
          <input type="file" accept="image/*" class="form-control" name="post_image">
      </div>

      <div class="form-group post-modal-image-container">
        <label class="create-post-label" for="countries">@lang("translations.country")</label>
        <select name="country" class="form-control" id="country">
          @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">@lang("translations.create_post")</button>
  </form>
  </div>
</div>

  

 <!-- add appeal modal -->
 <div class="appeals-modal-wrapper">
  <div class="appeals-modal-content">
    <div class="close-modal-container">
      <span class="close-appeals-modal">&times;</span>
    </div>
    <form action="{{ route('user.appeals.store', Auth::id()) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
          <label class="create-post-label" for="title">@lang('translations.title')</label>
          <input type="text" class="form-control" name="appeal_title" value="{{ old('appeal_title') }}" placeholder="Title">
          @error('appeal_title')
          <p style="color:red">{{$message}}</p>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="description">@lang("translations.description")</label>
          <textarea name="appeal_description" class="text-area-form-control" id="appeal-description" cols="30" rows="10">{{ old('appeal_description') }}</textarea>
          @error('appeal_description')
          <p style="color:red">{{$message}}</p>
          @enderror
      </div>

      <div class="form-group modal-image-container">
          <label class="create-post-label" for="image">@lang("translations.image")</label>
          <input type="file" accept="image/*" multiple class="form-control" name="appeal_image[]">
          @error('appeal_image')
          <p style="color:red">{{$message}}</p>
          @enderror
          @if($errors->has('appeal_image.*'))
            @foreach($errors->get('appeal_image.*') as $error)
            @foreach($error as $err)
              <p style="color:red">{{$err}}</p>
            @endforeach
            @endforeach
          @endif
      </div>

      <div class="form-group modal-image-container">
        <label class="create-post-label" for="video">@lang("translations.video")</label>
        <input type="file" accept="video/*" class="form-control" name="appeal_video">
        @error('appeal_video')
          <span style="color:red">{{$message}}</span>
        @enderror
      </div>

      <div class="form-group modal-image-container">
        <label class="create-post-label" for="video">@lang("translations.pdf")</label>
        <input type="file" accept=".pdf" class="form-control" name="appeal_pdf">
        @error('appeal_pdf')
          <span style="color:red">{{$message}}</span>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">@lang("translations.create_appeal")</button>
  </form>
  </div>
</div>
  

@endsection
@push('js')

<script>
 window.uuxyz.uuxyzc = <?php echo json_encode($user_country); ?>
</script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/addPostComment.js') }}" defer type="module"></script>
<script src="{{ asset('js/addPostLike.js') }}" defer type="module"></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
<script src="{{ asset('js/loadPosts.js') }}" defer type="module"></script>
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
<script>
 var swiper = new Swiper(".swiper", {
        slidesPerView: 3,
        // slidesPerView: "auto",

        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
          100: {
            slidesPerView:1,
            spaceBetween: 30
          },
          480: {
            slidesPerView:1,
            spaceBetween: 30
          },
          640: {
            slidesPerView: 1,
            spaceBetween: 40
          },

          900: {
            slidesPerView: 3,
            spaceBetween: 40
          }
        },
      });
</script>
@endpush
