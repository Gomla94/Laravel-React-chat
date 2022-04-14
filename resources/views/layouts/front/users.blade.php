@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the users page of magaxat.com">
@endsection
@section('title')
Magaxat | Users
@endsection
@section('content')
<div class="navbar-background-wrapper"></div>
<div class="users-wrapper">
  <div class="search-users-wrapper">
    <div class="search-users-container">
      <form class="search-users-form" action="{{ route('all-users') }}" method="GET">
        <div class="form-group">
          <input
            type="text"
            class="users-search-input"
            name="user-name"
            placeholder="{{ __('translations.search') }}"
          />
          <i class="fas fa-search search-users-icon"></i>
        </div>
      </form>
    </div>
    <div class="users-filter-icon">
      <div class="filter-icon-wrapper">
        <i class="fa-solid fa-filter"></i>
      </div>
    </div>
   
  </div>
  <div class="users-container">
    @foreach($users as $user)
      <div class="single-user-wrapper">
        <div class="single-user-image-wrapper">
          <a href="#">
            <img src="{{ $user->image ?? asset('images/avatar.png') }}" alt="user-image" />
          </a>
        </div>
        <div class="single-user-info-wrapper">
          <div class="single-user-title-desc-container">
            <span class="single-user-title">
              <a href="#">{{ $user->name }} </a>
            </span>
            <span class="single-user-description">
              <a href="#">@ {{ $user->name }}</a>
            </span>
          </div>
          <div class="single-user-view-button-wrapper">
            @if(Auth::check())
              @if(Auth::user()->subscribed($user->unique_id))
              <div class="main-video-date-wrapper">
                <form action="{{ route('unsubscribe', $user->unique_id) }}" method="POST">
                  @csrf
                  <button class="main-video-user-subscribed-link">
                    <i class="fas fa-check"></i> {{ __('translations.subscribed') }}
                  </button>
                </form>
              </div>
              @else
              <div class="main-video-date-wrapper">
                <form action="{{ route('subscribe', $user->unique_id) }}" method="POST">
                  @csrf
                  <button class="main-video-user-subscribed-link">
                    {{ __('translations.subscribe') }}
                  </button>
                </form>
              </div>
              @endif
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
