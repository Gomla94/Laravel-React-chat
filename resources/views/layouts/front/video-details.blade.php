@extends('layouts.front.app')
@section('content')
<div class="container-fluid view-video-wrapper">
    <div class="view-main-video-wrapper">
        <div class="view-main-video-container">
        <video controls src="{{ asset($video->video_path) }}" class="main-video"></video>
        </div>
        <div class="main-video-title-wrapper">
            <span class="main-video-title">{{ $video->title }}</span>
        </div>
         <div class="view-main-video-details-container">
            <div class="main-video-user-image-wrapper">
                <img src="{{ asset($video->user->image ?? 'images/avatar.png') }}" class="main-video-user-image" />
            </div>
        
            <div class="main-video-info">
            <div class="main-video-user-name-wrapper">
                <span class="main-video-user-name">{{ $video->user->name }}</span>
            </div>
            <div class="main-video-time-wrapper">
                <span class="main-video-time">{{ $video->created_at->diffForHumans() }}</span>
            </div>
            </div>
         </div>
    </div>
    <div class="view-other-videos-wrapper">
        @foreach($other_videos as $other_video)
         <div class="other-video-wrapper">
             <div class="other-video-container">
               <a href="{{ route('show-video', $other_video->id) }}"><video src="{{ asset($other_video->video) }}"></video></a>
             </div>
             <div class="other-video-info-wrapper">
               <div class="other-video-title-wrapper">
                {{ $other_video->title }}
               </div>
               <div class="other-video-user-wrapper">
                 {{ $other_video->user->name }}
               </div>
               <div class="other-video-time-wrapper">
                 {{ $other_video->created_at->diffForHumans() }}
               </div>
             </div>
         </div>
        @endforeach
    </div>
</div>
@endsection