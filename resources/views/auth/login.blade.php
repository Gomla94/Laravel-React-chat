@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
<div class="login-main-container">
  <div class="btns-wrapper">
    <div class="login-links-wrapper">
      <div>
        <a href="{{ route('login') }}" class="{{ Request::url('login') ? 'active-auth-button' : 'login-btn' }}">{{__('auth.login')}}</a>
      </div>
      <div>
        <a href="{{ route('register') }}" class="signup-btn">{{__('auth.register')}}</a>
      </div>
    </div>
  </div>
  <div class="login-wrapper">
    <div class="login-container">
      <div class="login-top">
        <div class="login-top-items">
          <span class="login-top-span">Вход</span>
        </div>
      </div>
      <div class="login-middle">
        <form action="{{ route('login') }}" method="POST" class="login-form">
          @csrf
          <div class="input-group">
            <label for="" class="input-label">Ваш e-mail</label>
            <input
              type="text"
              class="form-input"
              name="email"
              value="{{ old('email') }}"
              placeholder="maks-roma@mail.ru"
            />
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group">
            <label for="" class="input-label">Пароль</label>
            <input type="password" name="password" class="form-input" />
            @error('password')
            <span style="color: red">{{$message}}</span>
            @enderror
          </div>
          <div class="check-group">
            <input type="checkbox" class="check-input" />
            <label for="" class="input-label">Запомнить меня</label>
            <a href="{{ route('password.request') }}" class="link">Забыли пароль?</a>
          </div>

          <button class="form-btn">Войти</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
