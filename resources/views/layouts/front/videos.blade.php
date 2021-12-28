@extends('layouts.front.app')
@section('content')
<div class="container-fluid all-videos-wrapper">
    <div class="all-videos-container">
    @foreach($videos as $video)
      <div class="video-wrapper">
        <div class="video-container">
          <a href="{{ route('show-video', $video->id) }}">
            <video class="video-item" src="{{ asset($video->video) }}"></video>
          </a>
        </div>
        <div class="video-details-container">
          <div class="video-user-image-container">
            <img src="{{ asset($video->user->image ?? 'images/avatar.png')}}" class="video-user-image" alt="" />
          </div>
          <div class="video-info">
            <div class="video-name-container">
              <span class="video-title">{{ str_limit($video->title, 25) }}</span>
            </div>
            <div class="video-user-name-container">
              <span class="video-user-name">{{ $video->user->name }}</span>
            </div>
            <div class="video-time-container">
              <span class="video-time">{{ $video->created_at->diffForHumans() }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
@endsection