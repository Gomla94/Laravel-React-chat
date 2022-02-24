@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the appeals page in magaxat.com">
@endsection
@section('content')
<div class="container-fluid all-users-wrapper">
  <div class="container all-users-list">
    @foreach($appeals as $appeal)
    <div class="user">
      <a rel="preconnect" href="{{ route('show-appeal', $appeal->id) }}">
        @if($appeal->image_path)
        <div class="user-image-wrapper">
          <img src="{{ asset($appeal->image_path) }}" alt="appeal-image" />
        </div>
        @endif
      </a>
      <div class="users-social">
        <span class="appeal-title">
          <a rel="preconnect" href="{{ route('show-appeal', $appeal->title) }}">
          {{ $appeal->title }}
          </a>
        </span>
        <span class="appeal-description">{{ str_limit($appeal->description, 100) }}</span>
        
      </div>
    </div>
    @endforeach
    {{$appeals->links('vendor.pagination.custom')}}
  </div>
</div>
@endsection