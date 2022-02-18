@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the users page of magaxat.com">
@endsection
@section('content')
<div class="container-fluid all-users-wrapper">
  <div class="filter-all-users-container">
    <div class="filter-users-wrapper">
      <span class="filter-users-text">@lang("translations.filter")</span>
      <i class="fas fa-filter"></i>
    </div>
  </div>
  <div class="filters-list">
    <div class="filter-item">
      <span class="filter-item-span">@lang("translations.interest")</span>
      <i class="fas fa-chevron-right filter-item-arrow"></i>
      <ul class="sub-filters-list">
        @foreach($interesting_types as $type)
        <a rel="preconnect" href="{{ route('all-users', array_merge(request()->query(), ['interesting-in-type' => $type->name])) }}"><li class="sub-filter-item">{{ $type->name }}</li></a>
        @endforeach
      </ul>
    </div>
    <div class="filter-item">
      <span class="filter-item-span">@lang("translations.country")</span>
      <i class="fas fa-chevron-right filter-item-arrow"></i>
      <ul class="sub-filters-list">
        @foreach($countries as $country)
        <a rel="preconnect" href="{{ route('all-users', array_merge(request()->query(), ['country' => $country->name])) }}"><li class="sub-filter-item">{{ $country->name }}</li></a>
        @endforeach
      </ul>
    </div>
    <div class="filter-item">
      <span class="filter-item-span">@lang('translations.gender')</span>
      <i class="fas fa-chevron-right filter-item-arrow"></i>
      <ul class="sub-filters-list">
        <a rel="preconnect" href="{{ route('all-users', array_merge(request()->query(), ['gender' => 'male'])) }}"><li class="sub-filter-item">@lang("translations.male")</li></a>
        <a rel="preconnect" href="{{ route('all-users', array_merge(request()->query(), ['gender' => 'female'])) }}"><li class="sub-filter-item">@lang("translations.female")</li></a>
      </ul>
    </div>
  </div>
  <div class="container all-users-list">
    @foreach($users as $user)
    <div class="user">
      <a rel="preconnect" href="{{ route('user.page', $user->unique_id) }}">
        <div class="user-image-wrapper">
          @if ($user->image === null && $user->gender === 'female')
            <img src="{{ asset($user->image ?? 'images/female-avatar.png') }}" alt="user-image" />
          @elseif($user->image === null && $user->gender === 'male')
            <img src="{{ asset($user->image ?? 'images/avatar.png') }}" alt="user-image" />
          @else
            <img src="{{ asset($user->image ?? 'images/avatar.png') }}" alt="user-image" />
          @endif
        </div>
      </a>
      <div class="users-social">
        <span class="user-social-span">{{ $user->name }}</span>
        <span class="user-social-span">{{ $user->email }}</span>
      </div>
      @if(Auth::check())
        <div class="user-subscription-button" data-uunid={{ $user->unique_id }}>
          @if(auth()->user()->subscribed($user->unique_id))
          <div class="user-green-message-box" data-nid={{ $user->unique_id }}>
            <i class="fas fa-envelope user-envelope"></i>
          </div>
          <form action="{{ route('unsubscribe', $user->unique_id) }}" class="unsub-form" method="POST">
            @csrf
            <button class="fas fa-check checkmark-icon"></button>
          </form>
          @else
          <form action="{{ route('subscribe', $user->unique_id) }}" class="sub-form" method="POST">
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
  </div>
</div>
@endsection
