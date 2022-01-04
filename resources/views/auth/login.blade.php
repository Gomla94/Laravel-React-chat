@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
  <div class="wrapper">
    <div class="btns-wrapper">
      <div class="links-wrapper">
        <div class="login-button">
          <a href="{{ route('login') }}" class="{{ Request::url('login') ? 'active-auth-button' : '' }}">{{__('auth.login')}}</a>
        </div>
        <div class="signup-button">
          <a href="{{ route('register') }}" class="{{ Request::url('register') ? 'active-auth-button' : '' }}">{{__('auth.register')}}</a>
        </div>
      </div>
    </div>
    <div class="login-wrapper">
      <div class="login-top">
        <div class="login-top-items">
          <span class="login-top-span">Вход</span>
        </div>
      </div>
      <div class="login-middle">
        <form action="{{ route('login') }}" method="POST" class="login-form">
          @csrf
          <div class="form-group">
            <label for="email">Ваш e-mail</label>
            <input class="form-control form-input" type="text" />
          </div>
          @error('email')
              <span style="color:red">{{$message}}</span>
          @enderror
          <div class="form-group">
            <label for="password">Пароль</label>
            <input class="form-control form-input" type="password" />
          </div>
          @error('password')
              <span style="color:red">{{$message}}</span>
          @enderror
          <div class="check-group">
            <div class="form-group">
              <input type="checkbox" class="check-input" />
              <label for="" class="input-label">Запомнить меня</label>
            </div>
            <div class="reset-password-wrapper">
              <a href="" class="link">Забыли пароль?</a>
            </div>
          </div>
          <button class="form-btn">Login</button>
        </form>
      </div>
    </div>
  </div>
@endsection
