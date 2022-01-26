@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
  <div class="main-page-button-wrapper">
      <a href="{{ route('welcome') }}"
        ><img
          src="{{asset('images/dark-logo.jpeg')}}"
          class="navbar-logo"
          alt=""
      /></a>
  </div>
  <div class="god-container">
    <div class="super-container1">
      <h2 class="title-h2">@lang('translations.welcm')!</h2>

      <div class="container-p">
        <p class="subtitle-p">
          @lang('translations.inf')
        </p>

        <div class="div-button1">
          <a class="button1" href="{{ route('register') }}">@lang('translations.sign')</a>
        </div>
      </div>
    </div>

    <br />
    <div class="super-container2">
      <div class="title-container">
        <h1>@lang('translations.login')</h1>
      </div>
      <div class="form">
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="input-div">
            <label for="email"></label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="E-mail" />
          </div>
          @error('email')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div">
            <label for="password"></label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
            />
          </div>
          @error('password')
            <span style="color:red">{{$message}}</span>
          @enderror
          <a class="forgot-link" href="{{route('password.request')}}">@lang('translations.forgot-password')</a>
          <div class="button">
            <button class="button2">@lang('translations.login')</button>
          </div>
        </form>
      </div>

    </div>
  </div>
@endsection
