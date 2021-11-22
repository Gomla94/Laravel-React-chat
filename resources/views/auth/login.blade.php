@extends('layouts.auth')
@section('content')

<div class="wrapper">
  <div class="login-wrapper">
    <div class="login-top">
      <div class="login-top-items">
        <span class="login-top-span">Вход</span>
        <span class="login-top-span">Регистрация</span>
      </div>
    </div>
    <div class="login-middle">
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <div class="input-group">
          <label for="" class="input-label">Ваш e-mail</label>
          <input
            type="text"
            class="form-input"
            name="email"
            placeholder="maks-roma@mail.ru"
          />
          <i class="fas fa-user"></i>
        </div>
        <div class="input-group">
          <label for="" class="input-label">Пароль</label>
          <input type="password" name="password" class="form-input" />
          <i class="fas fa-eye"></i>
        </div>
        <div class="check-group">
          <input type="checkbox" name="remember" id="remember" {{
          old('remember') ? 'checked' : '' }}/>
          <label for="" class="input-label">Запомнить меня</label>
          <a href="{{ route('password.request') }}" class="link"
            >Забыли пароль?</a
          >
        </div>

        <button class="form-btn">Войти</button>
      </form>
    </div>
  </div>
</div>
@endsection
