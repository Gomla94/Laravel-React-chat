@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the benefactors page in magaxat.com">
@endsection
@section('content')
<div class="navbar-background-wrapper"></div>
  <div class="benefactors-wrapper">
    <div class="search-benefactors-wrapper">
      <div class="search-container">
        <form action="">
          <div class="form-group">
            <input
              type="text"
              class="benefactors-search-input"
              placeholder="Search"
            />
            <i class="fas fa-search"></i>
          </div>
        </form>
      </div>
    </div>
    <div class="benefactors-container">
      @foreach($benefactors as $benefactor)
        <div class="single-benefactors-wrapper">
          <div class="single-benefactors-image-wrapper">
            <img src="{{ $benefactor->image ?? asset('images/avatar.png') }}" alt="benefactors-image" />
          </div>
          <div class="single-benefactors-info-wrapper">
            <div class="single-benefactors-title-desc-container">
              <span class="single-benefactors-title">{{ $benefactor->name }}</span>
              <span class="single-benefactors-description"
                >@ {{ $benefactor->name }}</span>
            </div>
            <div class="single-benefactors-view-button-wrapper">
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
              {{-- <a href="" class="benefactors-message-link"
                ><i class="fa-regular fa-comment"></i>Message</a
              > --}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
