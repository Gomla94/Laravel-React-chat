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
      <form action="">
        <div class="form-group">
          <input
            type="text"
            class="users-search-input"
            placeholder="Search"
          />
          <i class="fas fa-search"></i>
        </div>
      </form>
    </div>
    <div class="users-filter-icon">
      <div class="filter-icon-wrapper">
        <i class="fa-solid fa-filter"></i>
      </div>
    </div>
    <div class="users-filter-selects">
      <select name="" class="filter-interest-select" id="">
        <option value="" selected disabled>Interests</option>
        <option value="">it</option>
        <option value="">health</option>
        <option value="">tech</option>
      </select>
      <select name="" class="filter-gender-select" id="">
        <option value="" selected disabled>Gender</option>
        <option value="">it</option>
        <option value="">health</option>
        <option value="">tech</option>
      </select>
      <select name="" class="filter-country-select" id="">
        <option value="" selected disabled>Country</option>
        <option value="">it</option>
        <option value="">health</option>
        <option value="">tech</option>
      </select>
    </div>
  </div>
  <div class="users-container">
    @foreach($users as $user)
      <div class="single-user-wrapper">
        <div class="single-user-image-wrapper">
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
@endsection
