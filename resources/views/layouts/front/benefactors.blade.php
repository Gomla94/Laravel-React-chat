@extends('layouts.front.app')
@section('content')
<div class="all-users-section">
    {{-- <div class="filter-users-container">
        <div class="filter-users">
          <span class="filter-users-text">Фильтр</span>
          <i class="fas fa-filter"></i>
        </div>
    </div>
    <div class="filters-list">
        <div class="filter-item">
          <span class="filter-item-span">По возрасту</span>
          <i class="fas fa-chevron-right filter-item-arrow"></i>
          <ul class="sub-filters-list">
            <li class="sub-filter-item">item one</li>
            <li class="sub-filter-item">item two</li>
            <li class="sub-filter-item">item three</li>
            <li class="sub-filter-item">item four</li>
            <li class="sub-filter-item">item five</li>
          </ul>
        </div>
        <div class="filter-item">
          <span class="filter-item-span">По возрасту</span>
          <i class="fas fa-chevron-right filter-item-arrow"></i>
          <ul class="sub-filters-list">
            <li class="sub-filter-item">item six</li>
            <li class="sub-filter-item">item seven</li>
            <li class="sub-filter-item">item eight</li>
            <li class="sub-filter-item">item nine</li>
            <li class="sub-filter-item">item ten</li>
          </ul>
        </div>
        <div class="filter-item">
          <span class="filter-item-span">По возрасту</span>
          <i class="fas fa-chevron-right filter-item-arrow"></i>
          <ul class="sub-filters-list">
            <li class="sub-filter-item">item six</li>
            <li class="sub-filter-item">item seven</li>
            <li class="sub-filter-item">item eight</li>
            <li class="sub-filter-item">item nine</li>
            <li class="sub-filter-item">item ten</li>
          </ul>
        </div>
        <div class="filter-item">
          <span class="filter-item-span">По возрасту</span>
          <i class="fas fa-chevron-right filter-item-arrow"></i>
          <ul class="sub-filters-list">
            <li class="sub-filter-item">item six</li>
            <li class="sub-filter-item">item seven</li>
            <li class="sub-filter-item">item eight</li>
            <li class="sub-filter-item">item nine</li>
            <li class="sub-filter-item">item ten</li>
          </ul>
        </div>
        <div class="filter-item">
          <span class="filter-item-span">По возрасту</span>
          <i class="fas fa-chevron-right filter-item-arrow"></i>
          <ul class="sub-filters-list">
            <li class="sub-filter-item">item six</li>
            <li class="sub-filter-item">item seven</li>
            <li class="sub-filter-item">item eight</li>
            <li class="sub-filter-item">item nine</li>
            <li class="sub-filter-item">item ten</li>
          </ul>
        </div>
    </div> --}}

    <div class="all-users-list-container">
        <div class="all-users-list">
            @foreach($benefactors as $benefactor)
            
                <div class="user">
                  <a href="{{ route('user.page', $benefactor->id) }}">
                    <div class="users-image-wrapper">
                    <img src="{{ asset($benefactor->image ?? 'images/avatar.png') }}" alt="" />
                    </div>
                  </a>
                    <div class="users-social">
                    <span class="user-social-span">{{ $benefactor->name }}</span>
                    <span class="user-social-span">{{ $benefactor->email }}</span>
                    <span class="user-social-span">Открыть полный профиль</span>
                    </div>
                    @if(Auth::check())
                    <div class="user-green-message-box">
                    <i class="fas fa-envelope user-envelope" data-id={{ $benefactor->id }}></i>
                    </div>
                    @endif
                </div>
            @endforeach
            
            {{$benefactors->links('vendor.pagination.custom')}}
        </div>
    </div>

</div>

@endsection