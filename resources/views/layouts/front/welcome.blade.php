{{-- @extends('layouts.front.app')
@section('content')
<div class="brief">
    <div class="left-brief">
      <div class="brief-image-text">
        <span class="brief-image-title">Социальный сеть</span>
        <span class="brief-image-site">MAGAXAT.COM</span>
      </div>
      <img src="{{asset('images/toppng 1.png')}}" class="left-brief-image" />
    </div>
    <div class="right-brief">
      <div class="right-brief-title">
        Также как разбавленное изрядной долей эмпатии, рациональное мышление в
        значительной степени обусловливает важность позиций, занимаемых
        участниками в отношении поставленных задач. Как принято считать,
        интерактивные прототипы являются только методом политического участия
        и ассоциативно распределены по отраслям.
      </div>
      <div class="icons">
        <i class="fas fa-envelope"></i>
        <span class="mail-span"><a href="mailto:info@magaxat.com">info@magaxat.com</a></span>
      </div>
    </div>
  </div>


  <div class="help-section">
    <div class="help-title">Кому нужна помощь прямо сейчас</div>
     <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        @foreach($random_appeals as $appeal)
        <div class="swiper-slide">
          @if($appeal->image)
          <div class="appeal-card-image">
            <img class="appeal-image" src="{{ asset($appeal->image) }}" alt="">
          </div>
          @endif
          <div class="appeal-card-info">
            <p class="appeal-card-title">{{$appeal->title}}</p>
            <p class="appeal-card-description">
              {{str_limit($appeal->description, 200)}}
            </p>
            <div class="appeal-card-links">
              <button class="appeals-card-button">Хочу помочь</button>
              <a href="#" class="appeal-card-link">Подробнее</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="posts">
    <div class="posts-wrapper">
      <div class="posts-title">лента новостей</div>
      <div class="posts-details">
        <div class="search-input">
          <i class="fas fa-search post-search-icon"></i>
          <input class="post-search" placeholder="Поиск..." type="text" />
          <i class="fas fa-microphone posts-search-microhphone"></i>
        </div>
        <div class="posts-btn-details">
          @if(Auth::check())
          <button class="add-appeals-button">
            запрос о помощи
          </button>
          <i class="fal fa-plus"></i>
          <button class="posts-button">
            Новый пост
          </button>
          @endif
        </div>
      </div>
        @foreach($random_posts as $post)
            <div class="post">
                <div class="user-info">
                <div class="user-image-wrapper">
                    <img src="{{asset($post->user->image ?? 'images/avatar.png')}}" class="post-user-image" />
                </div>
                <a href="{{ route('user.page', $post->user->id) }}">
                  <div class="user-details">
                      <span class="user-title">{{ $post->user->name }}</span>
                      <span class="user-link">{{'@'. $post->user->name }}</span>
                  </div>
                </a>
                </div>

                <div class="post-details">
                <div class="post-media">
                      @if($post->title)
                      <div class="posts-title">
                        <p>{{ $post->title }}</p>
                      </div>
                      @endif
                    @if($post->image)
                    <div class="post-image-wrapper">
                        <img src="{{asset($post->image)}}" class="post-image" alt="" />
                    </div>
                    @endif
                    @if($post->video)
                    <div class="post-video-wrapper">
                        <video src="{{asset($post->video)}}" controls class="post-video" alt="" />
                    </div>
                    @endif
                </div>
                <p class="post-desc">
                    {{ str_limit($post->description, 500) }}
                </p>

                @if(Auth::check())
                <div class="post-comment-form-container">
                  <form class="post-comment-form">
                    @csrf
                    <textarea name="title" class="post-comment-input" id="{{ $post->id }}" cols="30" rows="10"></textarea>
                    <div class="comment-error-div">
                      <span class="comment-error-span"></span>
                    </div>
                    <button type="button" class="post-comment-btn">Add Comment</button>
                  </form>
                </div>
                @endif
                <div class="post-social">
                    <div class="social-icon first">
                      @if(Auth::check())
                      <i id="{{ $post->id }}" class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }} post-heart-icon"></i><span class="social-count">{{ $post->likes->count() }}</span>
                      @else
                      <i id="{{ $post->id }}" class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }}"></i><span class="social-count">{{ $post->likes->count() }}</span>
                      @endif
                    </div>
                    <div class="social-icon">
                    <i class="icon far fa-comment" id="{{ $post->id }}"></i><span class="social-count">{{ $post->comments->count() }}</span>
                    </div>
                </div>
                <div class="post-comments-container">
                  
                </div>
                </div>
            </div>
        @endforeach
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
            <input type="file" class="form-control" name="post_image">
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
            <input type="text" class="form-control" name="appeal_title" placeholder="Title">
            @error('appeal_title')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
  
        <div class="form-group">
            <label class="create-post-label" for="description">Description</label>
            <textarea name="appeal_description" class="text-area-form-control" id="description" cols="30" rows="10"></textarea>
            @error('appeal_description')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
  
        <div class="form-group modal-image-container">
            <label class="create-post-label" for="image">Image</label>
            <input type="file" class="form-control" name="appeal_image">
            @error('appeal_image')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group modal-image-container">
          <label class="create-post-label" for="video">Video</label>
          <input type="file" class="form-control" name="appeal_video">
          @error('appeal_video')
            <span style="color:red">{{$message}}</span>
          @enderror
      </div>
  
        <button type="submit" class="btn btn-primary create-post-modal-btn">Create Appeal</button>
    </form>
    </div>
  </div>
  
@endsection

@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/addPostComment.js') }}" defer></script>
<script src="{{ asset('js/addPostLike.js') }}" defer></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
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
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
  });
</script>
@endpush --}}


@extends('layouts.front.app')
@section('content')

<div class="container-fluid brief">
  <div class="brief-container">
    <div class="brief-image-wrapper">
      <div class="brief-image-container">
        <div class="brief-image-text">
          <span class="brief-image-title">Социальный сеть</span>
          <span class="brief-image-site">MAGAXAT.COM</span>
        </div>
        <img class="brief-image" src="{{asset('images/toppng 1.png')}}" />
      </div>
    </div>
    <div class="brief-info-wrapper">
      <div class="brief-info-container">
        <p class="brief-title">
          Также как разбавленное изрядной долей эмпатии, рациональное мышление в
          значительной степени обусловливает важность позиций, занимаемых
          участниками в отношении поставленных задач. Как принято считать,
          интерактивные прототипы являются только методом политического участия
          и ассоциативно распределены по отраслям.
        </p>
        <div class="brief-links">
          <!-- <div class="brief-phone-link">
              <a href="tel:+7 (000) 00 00 000">
                <i class="fas fa-phone-alt"></i>
                <span class="phone-span">+7 (000) 00 00 000</span></a
              >
            </div> -->
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

<div class="help-section">
  <div class="help-section-title">Кому нужна помощь прямо сейчас</div>
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      @foreach($random_appeals as $appeal)
      <div class="swiper-slide">
        <div class="appeal-card">
          <div class="appeal-card-image-wrapper">
            @if($appeal->image)
            <img src="{{ asset($appeal->image) }}" alt="appeal-image" class="appeal-card-image" />
            @endif
          </div>
          <div class="appeal-card-title">{{$appeal->title}}</div>
          <div class="appeal-card-description">
            {{str_limit($appeal->description, 200)}}
          </div>
          <button class="appeal-card-button">Хочу помочь</button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div class="main-posts">
  <div class="main-posts-buttons-container">
    <p class="main-posts-title">лента новостей</p>
    @if(Auth::check())
    <div class="main-posts-buttons-wrapper">
      <div class="main-posts-search-wrapper">
        <i class="fas fa-search main-posts-search-icon"></i>
        <input type="text" class="main-posts-search-input" />
        <i class="fas fa-microphone main-posts-search-microhphone"></i>
      </div>
      <div class="main-posts-add-buttons">
        <button class="main-posts-add-appeal-button">запрос о помощи</button>
        <button class="main-posts-add-post-button">
          <i class="fal fa-plus"></i>
          Новый пост
        </button>
      </div>
    </div>
    @endif
  </div>
  <div class="posts-wrapper">
    @foreach($random_posts as $post)
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
        <span class="post-date">{{ $post->created_at->format('Y-m-d') }}</span>
      </div>
      <p class="main-post-title">@if($post->title) {{ $post->title }} @endif</p>
      <p class="main-post-description">
        @if($post->description) {{ str_limit($post->description, 500) }} @endif
      </p>

      @if($post->image)
      <div class="main-post-image-wrapper">
        <img src="{{ asset($post->image) }}" alt="main-post-image" class="main-post-image" />
      </div>
      @endif @if($post->video)
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
          <input type="file" class="form-control" name="post_image">
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
          <input type="text" class="form-control" name="appeal_title" placeholder="Title">
          @error('appeal_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="description">Description</label>
          <textarea name="appeal_description" class="text-area-form-control" id="description" cols="30" rows="10"></textarea>
          @error('appeal_description')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-image-container">
          <label class="create-post-label" for="image">Image</label>
          <input type="file" class="form-control" name="appeal_image">
          @error('appeal_image')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group modal-image-container">
        <label class="create-post-label" for="video">Video</label>
        <input type="file" class="form-control" name="appeal_video">
        @error('appeal_video')
          <span style="color:red">{{$message}}</span>
        @enderror
    </div>

      <button type="submit" class="btn btn-primary create-post-modal-btn">Create Appeal</button>
  </form>
  </div>
</div>

@endsection
@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/addPostComment.js') }}" defer></script>
<script src="{{ asset('js/addPostLike.js') }}" defer></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
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
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
</script>
@endpush
