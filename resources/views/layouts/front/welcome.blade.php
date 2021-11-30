@extends('layouts.front.app')
@section('content')
<div class="brief">
    <div class="left-brief">
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
      <button class="right-brief-button">Хочу помочь</button>
      <div class="icons">
        <i class="fas fa-phone-alt"></i>
        <span class="phone-span"> +7 (000) 00 00 000 </span>
        <i class="fas fa-envelope"></i>
        <span> magaxat@info.com </span>
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
        <div class="posts-btn-details">
          <button class="posts-button">
            <i class="fal fa-plus"></i>Новый пост
          </button>
        </div>
      </div>
        @foreach($random_posts as $post)
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
    </div>
  </div>
@endsection

@push('js')

@endpush