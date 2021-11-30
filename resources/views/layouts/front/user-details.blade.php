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
            <img class="user-info-image" src="{{ asset($user->image) }}" alt="">
        </div>
        <div class="user-details-container">
            <span class="user-info-span">Максим Романов</span>
            <span class="user-info-span">romanov@mail.ru</span>
            <span class="user-info-span">ID 0000000000</span>
        </div>
      </div>
      <div class="user-page-green-button">Информация о пользователе</div>
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
          <i class="fas fa-microphone user-info-microphone-icon"></i>
        </div>
      </div>
      <div class="user-info-media-container">
        <div class="media-details">
            <span class="media-span media-title media-images-count-title">Фото</span>
            <i class="fas fa-file-image media-icon media-image-icon"></i>  
            <span class="meida-count">15</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-videos-count-title">Видео</span>
            <i class="fas fa-photo-video media-icon media-videos-icon"></i>  
            <span class="meida-count">3</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-posts-count-title">Публикации</span>
            <i class="fas fa-book-open media-icon media-book-icon"></i>  
            <span class="meida-count">30</span>
        </div>
        <div class="media-details">
            <span class="media-span media-title media-subscribers-count-title">Подписчики</span>
            <i class="fas fa-users media-icon media-image-icon"></i>  
            <span class="meida-count">1500</span>
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
            <img src="{{asset($post->user->image)}}" class="post-user-image" />
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
        <div class="post-social">
            <div class="social-icon first">
            <i class="icon far fa-heart"></i>1.6k
            </div>
            <div class="social-icon">
            <i class="icon far fa-comment"></i>2.3k
            </div>
        </div>
        </div>
    </div>
      @endforeach
      <!-- </div> -->

      
    </div>
  </div>
@endsection