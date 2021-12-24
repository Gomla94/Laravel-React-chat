@extends('layouts.front.app')
@section('content')
<div class="user-info-top-section">
  <div class="left-top-section">
    <div class="left-section-items">
      <div class="filter-container">
          <span class="filter-text">Фильтр</span>
          <i class="fas fa-filter user-page-filter-icon"></i>
      </div>
      <div class="user-page-user-info-container">
        <div class="user-info-image-container">
            <img class="user-info-image" src="{{ asset($user->image ?? 'images/avatar.png') }}" alt="">
        </div>
        <div class="user-details-container">
            <span class="user-info-span">{{ $user->name }}</span>
            <span class="user-info-span">{{ $user->email }}</span>
        </div>
      </div>
      <div class="user-page-green-button"><span class="green-button-text">Информация о пользователе</span></div>
      <div class="user-additional-info">
        @if($user->date_of_birth)
        <div class="info">
          <div class="info-name">Дата рождения</div>
          <div class="info-value">{{ $user->date_of_birth }}</div>
        </div>
        @endif
        @if($user->email)
        <div class="info">
          <div class="info-name">Электронный адрес</div>
          <div class="info-value">{{ $user->email }}</div>
        </div>
        @endif
        <div class="info">
          <div class="info-name">Пол</div>
          <div class="info-value">{{ $user->name }}</div>
        </div>
        @if($user->age)
        <div class="info">
          <div class="info-name">Возраст</div>
          <div class="info-value">{{ $user->age }}</div>
        </div>
        @endif
        @if($interesting_type)
        <div class="info">
          <div class="info-name">Сфера деятельнсоти</div>
          <div class="info-value">{{ $interesting_type->name }}</div>
        </div>
        @endif
      </div>
    </div>
  </div>
  <div class="right-top-section">
    <div class="right-section-items">
      <div class="user-info-search-container">
        <div class="search-items">
          <input class="right-section-post-search" placeholder="Поиск..." type="text" />
          <i class="fas fa-search user-info-search-icon"></i>
        </div>
      </div>
      <div class="user-info-media-container">
        <div class="media-details">
            <span class="media-span media-title media-images-count-title">Фото</span>
            <i class="fas fa-file-image media-icon media-image-icon"></i>  
            <span class="meida-count">{{ $user_images_count }}</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-videos-count-title">Видео</span>
            <i class="fas fa-photo-video media-icon media-videos-icon"></i>  
            <span class="meida-count">{{ $user_videos_count }}</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-posts-count-title">Публикации</span>
            <i class="fas fa-book-open media-icon media-book-icon"></i>  
            <span class="meida-count">{{ $user_posts_count }}</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-subscribers-count-title">подписчики</span>
            <i class="fas fa-user media-icon media-image-icon"></i>  
            <span class="meida-count">{{ $user->subscribtions->count() }}</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-subscribers-count-title">подписки</span>
            <i class="fas fa-users media-icon media-image-icon"></i>  
            <span class="meida-count">{{ $user->subscribers->count() }}</span>
        </div>
      </div>
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
          <button class="posts-button">
            <i class="fal fa-plus"></i>Новый пост
          </button>
        </div>
      </div>
      @foreach($user->posts as $post)
      <div class="post">
        <div class="user-info">
        <div class="user-image-wrapper">
            <img src="{{asset($post->user->image ?? 'images/avatar.png')}}" class="post-user-image" />
        </div>
        <div class="user-details">
            <span class="user-title">{{ $post->user->name }}</span>
            <span class="user-link">{{'@'. $post->user->name }}</span>
        </div>
        </div>

        <div class="post-details">
        <div class="post-media">
            <!-- <div class="left-media"> -->
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
        {{-- <div class="post-social">
            <div class="social-icon first">
            <i class="icon far fa-heart"></i>1.6k
            </div>
            <div class="social-icon">
            <i class="icon far fa-comment"></i>2.3k
            </div>
        </div> --}}
        </div>
    </div>
      @endforeach
      <!-- </div> -->

      
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
          <input type="text" class="form-control" name="post_title" placeholder="Title" value="{{ old('post_title') }}">
          @error('post_title')
          <span style="color:red">{{$message}}</span>
          @enderror
      </div>

      <div class="form-group">
          <label class="create-post-label" for="post_description">Description</label>
          <textarea name="post_description" class="text-area-form-control" id="description" cols="30" rows="10">{{ old('post_description') }}</textarea>
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

@push('js')
<script>
  const modalContent = document.querySelector('.posts-modal-wrapper');
  @if (count($errors) > 0)
  modalContent.style.display="block"
  @endif
</script>

<script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
@endpush
@endsection