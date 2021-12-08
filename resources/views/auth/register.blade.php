@extends('layouts.auth')
@section('title')
Register
@endsection
@section('content')
<div class="register-main-container">
  <div class="btns-wrapper">
    <div class="register-links-wrapper">
      <div>
        <a href="{{ route('login') }}" class="login-btn">{{__('auth.login')}}</a>
      </div>
      <div>
        <a href="{{ route('register') }}" class="{{ Request::url('login') ? 'active-auth-button' : 'login-btn' }}">{{__('auth.register')}}</a>
      </div>
    </div>
  </div>
  <div class="login-wrapper">
    <div class="login-container">
      <div class="register-top">
        <div class="login-top-items">
          <span class="login-top-span">Регистрация</span>
        </div>
      </div>
      <div class="register-middle">
        <form action="{{ route('register') }}" method="POST" class="register-form">
          @csrf
          <div class="input-group">
            <label for="name" class="input-label">Имя</label>
            <input type="text" id="name" class="form-input" name="name" value="{{ old('name') }}" />
            @error('name')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group">
            <label for="email" class="input-label">Ваш e-mail</label>
            <input
              type="email"
              class="form-input"
              name="email"
              placeholder="maks-roma@mail.ru"
              value="{{ old('email') }}"
            />
            @error('email')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group">
            <label for="password" class="input-label">Пароль</label>
            <input type="password" id="password" class="form-input" name="password" />
            <i class="fas fa-eye show-password-icon"></i>
            @error('password')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group">
            <label for="phone_number" class="input-label">Номер телефона</label>
            <input type="text" id="phone_number" class="form-input" name="phone_number"value="{{ old(
              'phone_number'
            ) }}" />
            @error('phone_number')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group">
            <label for="type" class="input-label">тип</label>
            <select name="type" class="form-input types-list" id="type">
              <option value="benefactor">Benefactor</option>
              <option value="ordinary_user">Ordinary User</option>
            </select>
            @error('type')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group interesting-types-group-div">
            <label for="types-list" class="input-label interesting-types-label">Area Of Interesting</label>
          </div>

          <div class="input-group">
            <label for="child-types" class="input-label child-types-label">Additional Type</label>
            <select name="additional_type" class="form-input child-types-select" id="child-types-list">
              <option value="" disabled selected>Select Type</option>
              <option value="individual">Individual</option>
              <option value="organisation">Organisation</option>
            </select>
            @error('additional_type')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>

          <div class="input-group">
            <label for="organisation" class="input-label organisation-label">Organisation Description</label>
            <textarea name="organisation_description" class="text-area-form-input organisation-input" id="organisation" cols="30" rows="10"></textarea>
            @error('organisation_description')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="check-group">
            <input type="checkbox" class="check-input" />
            <label for="" class="input-label">Запомнить меня</label>
          </div>
          <button class="form-btn">Войти</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="{{ asset('js/authentication.js') }}"></script>
@endpush
@endsection
