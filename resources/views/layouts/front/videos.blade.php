@extends('layouts.front.app')
@section('content')
<div class="all-videos-container">
    @foreach($videos as $video)
    <div class="one-video-wrapper">
        <div class="one-video-container">
            <a href="{{ route('show-video', $video->id) }}">
                <video class="video-item" src="{{ asset($video->video) }}"></video>
            </a>
       </div>
       <div class="one-video-details-container">
            <div class="one-video-user-image-container">
                <img src="{{ asset($video->user->image ?? 'images/avatar.png')}}" class="one-video-user-image" alt="">
            </div>
            <div class="one-video-info">
                <div class="one-video-name-container">
                    <span class="one-video-title">{{ $video->title }}</span>
                </div>
                <div class="one-video-user-name-container">
                    <span class="one-video-user-name">{{ $video->user->name }}</span>
                </div>
                <div class="one-video-time-container">
                    <span class="one-video-time">{{ $video->created_at->diffForHumans() }}</span>
                </div>
            </div>
            
       </div>
    </div> 
    @endforeach 
</div>
@endsection