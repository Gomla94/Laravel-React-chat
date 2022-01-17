@extends('layouts.front.app')
@section('content')
<div class="container-fluid all-users-wrapper">
  <div class="container all-users-list">
    @foreach($benefactors as $benefactor)
    <div class="user">
      <a href="{{ route('user.page', $benefactor->id) }}">
        <div class="user-image-wrapper">
          <img src="{{ asset($benefactor->image ?? 'images/avatar.png') }}" alt="user-image" />
        </div>
      </a>
      <div class="users-social">
        <span class="user-social-span">{{ $benefactor->name }}</span>
        <span class="user-social-span">{{ $benefactor->email }}</span>
        <span class="user-social-span">@lang('translations.open_all_path')</span>
      </div>
      @if(Auth::check())
        <div class="user-subscription-button">
          <div class="user-green-message-box">
            <i class="fas fa-envelope user-envelope" data-id={{ $benefactor->id }}></i>
          </div>
        </div>
      @endif
    </div>
    @endforeach
    {{$benefactors->links('vendor.pagination.custom')}}
  </div>
</div>
@endsection
