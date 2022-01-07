@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
  {{-- <div class="wrapper">
    <div class="btns-wrapper">
      <div class="links-wrapper">
        <div class="login-button {{ Route::currentRouteName() === "login" ? 'active-auth-button' : '' }}">
          <a href="{{ route('login') }}">{{__('auth.login')}}</a>
        </div>
        <div class="signup-button {{ Route::currentRouteName() === "register" ? 'active-auth-button' : '' }}">
          <a href="{{ route('register') }}">{{__('auth.register')}}</a>
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
            <input class="form-control form-input" name="email" type="text" />
          </div>
          @error('email')
              <span style="color:red">{{$message}}</span>
          @enderror
          <div class="form-group">
            <label for="password">Пароль</label>
            <input class="form-control form-input" name="password" type="password" />
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
  </div> --}}

  <div class="god-container">
    <div class="super-container1">
      <h2 class="title-h2">Welcome Back!</h2>

      <div class="container-p">
        <p class="subtitle-p">
          To keep connected with us please login with your personal info.
        </p>

        <div class="div-button1">
          <a class="button1" href="{{ route('register') }}">Sign up</a>
        </div>
      </div>
    </div>

    <br />
    <div class="super-container2">
      <div class="title-container">
        <h1>Login</h1>
      </div>
      <!-- <div class="buttons-login">
        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#"><i class="fab fa-google fa-2x"></i></a>
        <a href="#"><i class="fab fa-twitter-square fa-2x"></i></a>
      </div> -->
      <!-- <div class="container-p">
        <p class="request-data">or us an e-mail for registration</p>
      </div> -->
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
          <!-- <div class="do-you-subrscibe">
            <label for="">Do you want subscribe for our newsletter?</label>
          </div>
          <label for="">Yes</label
          ><input type="radio" name="subscribe" id="Yes" />
          <label for="no">No</label>
          <input type="radio" name="subscribe" id="No" /> -->
          <div class="button">
            <button class="button2">Login</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
@endsection
