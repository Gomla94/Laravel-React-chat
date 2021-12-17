@extends('layouts.front.app')
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
        <a href="tel:+7 (000) 00 00 000">
        <i class="fas fa-phone-alt"></i>
        <span class="phone-span">+7 (000) 00 00 000</span></a>
        <i class="fas fa-envelope"></i>
        <span><a href="mailto:magaxat@info.com">magaxat@info.com</a></span>
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
              <button class="appeals-button">Хочу помочь</button>
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
          <button class="appeals-button">
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
                    <!-- <div class="left-media"> -->
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
                    <!-- </div> -->
                    <!-- <div class="right-media"></div> -->
                </div>
                <p class="post-desc">
                    {{ str_limit($post->description, 500) }}
                </p>

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
                <div class="post-social">
                    <div class="social-icon first">
                    <i id="{{ $post->id }}" class="icon fas {{ $post->likes->where('user_id', Auth::id())->count() !== 0 ? 'fa-heart liked-post-heart-icon' : 'fa-heart' }} post-heart-icon"></i><span class="social-count">{{ $post->likes->count() }}</span>
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
      <form action="{{ route('user.posts.store', Auth::id()) }}" method="POST" enctype="multipart/form-data">
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
        
  
        <div class="form-group modal-image-container">
            <label class="create-post-label" for="image">Image</label>
            <input type="file" class="form-control" name="image">
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
@endpush