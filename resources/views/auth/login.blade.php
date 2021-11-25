@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
<div class="wrapper">
  <div class="btns-wrapper">
    <div class="links-wrapper">
      <div>
        <a href="{{ route('login') }}" class="login-btn">Создать аккаунт</a>
      </div>
      <div>
        <a href="{{ route('register') }}" class="signup-btn">Войти в аккаунт</a>
      </div>
    </div>
  </div>
  <div class="login-wrapper">
    <div class="login-container">
      <div class="login-top">
        <div class="login-top-items">
          <span class="login-top-span">Вход</span>
          <span class="login-top-span">Регистрация</span>
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
              placeholder="maks-roma@mail.ru"
            />
          </div>
          <div class="input-group">
            <label for="" class="input-label">Пароль</label>
            <input type="password" name="password" class="form-input" />
            <i class="fas fa-eye"></i>
          </div>
          <div class="check-group">
            <input type="checkbox" class="check-input" />
            <label for="" class="input-label">Запомнить меня</label>
            <a href="#" class="link">Забыли пароль?</a>
          </div>

          <button class="form-btn">Войти</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
