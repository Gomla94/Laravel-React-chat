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
    <div class="appeals-wrapper">
        @foreach($random_appeals as $appeal)
            <div class="appeal-card">
                <div class="appeal-card-image">
                    @if($appeal->image)
                    <img
                    src="{{asset($appeal->image)}}"
                    class="card-user-image"
                    />
                    @endif
                </div>
                <div class="appeal-card-info">
                    <p class="user-name">{{ $appeal->user->name }}</p>
                    <p class="user-desc">
                        {{ str_limit($appeal->description, 100) }}
                    </p>
                    <button class="user-btn">Хочу помочь</button>
                    <a href="" class="more-details">Подробнее</a>
                </div>
               
            </div>
        @endforeach
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
        @if(Auth::check())
        <div class="posts-btn-details">
          <button class="posts-button">
            <i class="fal fa-plus"></i>Новый пост
          </button>
        </div>
        @endif
      </div>
        @foreach($random_posts as $post)
            <div class="post">
                <div class="user-info">
                <div class="user-image-wrapper">
                    <img src="{{asset($post->user->image)}}" class="post-user-image" />
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
  <div class="modal-wrapper">

    <div class="modal-content">
      <div class="close-modal-container">
        <span class="close-modal">&times;</span>
      </div>
      <form action="{{ route('user.posts.store', Auth::id()) }}" method="POST" enctype="multipart/form-data">
        @csrf
  
        <div class="form-group">
            <label class="create-post-label" for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title">
            @error('title')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
  
        <div class="form-group">
            <label class="create-post-label" for="description">Description</label>
            <textarea name="description" class="text-area-form-control" id="description" cols="30" rows="10"></textarea>
            @error('description')
            <span style="color:red">{{$message}}</span>
            @enderror
        </div>
  
        
        <div class="form-group modal-checker-container">
          <div class="post-modal-checker">
            <div class="modal-checker"></div>
          </div>
          <label class="create-post-label image-label">Image</label>
          <label class="create-post-label video-label">Video</label>
          @error('image')
            <span style="color:red">{{$message}}</span>
          @enderror
          @error('video')
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
@endsection

@push('js')
<script src="{{ asset('js/addPostComment.js') }}" defer></script>
<script src="{{ asset('js/addPostLike.js') }}" defer></script>
<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
<script>
  const modalContent = document.querySelector('.modal-wrapper');
  @if (count($errors) > 0)
  modalContent.style.display="block"
  @endif
</script>
@endpush