@extends('layouts.front.app')
@section('content')
<div class="users-page-wrapper">
    {{-- @if(Auth::check())
        <div id="root"></div>
    @endif --}}
    <div class="users-page-filter-wrapper"></div>
    <div class="users-page-list-wrapper">
        <div class="users-page-list">
            <div class="users-list-card">
                <div class="user-list-image-wrapper">
                    <img class="user-list-image" src="{{ asset('images/avatar.png') }}" alt="">
                </div>
                <div class="user-list-info">
                    <span class="user-info-span">name</span>
                    <span class="user-info-span">email</span>
                    <span class="user-info-span">1123456788</span>
                    <span class="user-info-span">this is a random text</span>
                </div>
                <div class="user-list-start-chat">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <div class="users-list-card">
                <div class="user-list-image-wrapper">
                    <img class="user-list-image" src="{{ asset('images/avatar.png') }}" alt="">
                </div>
                <div class="user-list-info">
                    <span class="user-info-span">name</span>
                    <span class="user-info-span">email</span>
                    <span class="user-info-span">1123456788</span>
                    <span class="user-info-span">this is a random text</span>
                </div>
                <div class="user-list-start-chat">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <div class="users-list-card">
                <div class="user-list-image-wrapper">
                    <img class="user-list-image" src="{{ asset('images/avatar.png') }}" alt="">
                </div>
                <div class="user-list-info">
                    <span class="user-info-span">name</span>
                    <span class="user-info-span">email</span>
                    <span class="user-info-span">1123456788</span>
                    <span class="user-info-span">this is a random text</span>
                </div>
                <div class="user-list-start-chat">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <div class="users-list-card">
                <div class="user-list-image-wrapper">
                    <img class="user-list-image" src="{{ asset('images/avatar.png') }}" alt="">
                </div>
                <div class="user-list-info">
                    <span class="user-info-span">name</span>
                    <span class="user-info-span">email</span>
                    <span class="user-info-span">1123456788</span>
                    <span class="user-info-span">this is a random text</span>
                </div>
                <div class="user-list-start-chat">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <div class="users-list-card">
                <div class="user-list-image-wrapper">
                    <img class="user-list-image" src="{{ asset('images/avatar.png') }}" alt="">
                </div>
                <div class="user-list-info">
                    <span class="user-info-span">name</span>
                    <span class="user-info-span">email</span>
                    <span class="user-info-span">1123456788</span>
                    <span class="user-info-span">this is a random text</span>
                </div>
                <div class="user-list-start-chat">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection