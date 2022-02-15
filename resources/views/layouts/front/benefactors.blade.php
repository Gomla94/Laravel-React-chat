@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the benefactors page in magaxat.com">
@endsection
@section('content')
<div class="container-fluid all-users-wrapper">
  <div class="container all-users-list">
    @foreach($benefactors as $benefactor)
    <div class="user">
      <a rel="preconnect" href="{{ route('user.page', $benefactor->unique_id) }}">
        <div class="user-image-wrapper">
          <img src="{{ asset($benefactor->image ?? 'images/avatar.png') }}" alt="user-image" />
        </div>
      </a>
      <div class="users-social">
        <span class="user-social-span">{{ $benefactor->name }}</span>
        <span class="user-social-span">{{ $benefactor->email }}</span>
        {{-- <span class="user-social-span">@lang('translations.open_all_path')</span> --}}
      </div>
      @if(Auth::check())
        <div class="user-subscription-button">
          <div class="user-green-message-box" data-nid={{ $benefactor->unique_id }}>
            <i class="fas fa-envelope user-envelope"></i>
          </div>
          @if(auth()->user()->subscribed($benefactor->unique_id))
          <form action="{{ route('unsubscribe', $benefactor->unique_id) }}" method="POST">
            @csrf
            <button class="fas fa-check checkmark-icon"></button>
          </form>
          @else
          <form action="{{ route('subscribe', $benefactor->unique_id) }}" method="POST">
            @csrf
            <button class="user-subscribe">
              @lang('translations.subscribe')
            </button>
          </form>
          @endif
        </div>
      @endif
    </div>
    @endforeach
    {{$benefactors->links('vendor.pagination.custom')}}
  </div>
</div>
@endsection
