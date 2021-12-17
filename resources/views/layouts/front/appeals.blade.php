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
            @foreach($appeals as $appeal)
            
                <div class="appeal-container">
                  <a href="{{ route('show-appeal', $appeal->id) }}">
                    <div class="users-image-wrapper">
                    <img src="{{ asset($appeal->user->image ?? 'images/avatar.png') }}" alt="" />
                    </div>
                  </a>
                    <div class="appeal-info-container">
                    <span class="appeal-title">{{ $appeal->title }}</span>
                    <span class="user-social-span">{{ str_limit($appeal->description, 150) }}</span>
                    </div>
                </div>
            @endforeach
            
            {{$appeals->links('vendor.pagination.custom')}}
        </div>
    </div>

</div>

@endsection