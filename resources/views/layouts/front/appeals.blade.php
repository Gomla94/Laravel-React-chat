@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the appeals page in magaxat.com">
@endsection
@section('content')
<div class="navbar-background-wrapper"></div>
<div class="appeals-wrapper">
  <div class="search-appeals-wrapper">
    <div class="search-container">
      <form action="">
        <div class="form-group">
          <input
            type="text"
            class="appeals-search-input"
            placeholder="Search"
          />
          <i class="fas fa-search"></i>
        </div>
      </form>
    </div>
  </div>
  <div class="appeals-container">
    @foreach($appeals as $appeal)
      <div class="single-appeal-wrapper">
        <div class="single-appeal-image-wrapper">
          <a href="{{ route('show-appeal', $appeal->uniqueid) }}">
            <img src="{{ $appeal->image_path }}" alt="appeal-image" />
          </a>
        </div>
        <div class="single-appeal-info-wrapper">
          <div class="single-appeal-title-desc-container">
            <p class="single-appeal-title">
             {{ $appeal->title }}
            </p>
            <p class="single-appeal-description">
              {{ $appeal->description }}
            </p>
          </div>
          <div class="single-appeal-view-button-wrapper">
            <a href="{{ route('show-appeal', $appeal->uniqueid) }}" class="view-appeal-link">View</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection