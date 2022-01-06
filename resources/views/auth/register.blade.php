@extends('layouts.auth')
@section('title')
Register
@endsection
@section('content')
  {{-- <div class="register-wrapper">
    <div class="register-btns-wrapper">
      <div class="links-wrapper">
        <div class="r-login-button {{ Route::currentRouteName() === 'login' ? 'active-auth-button' : '' }}">
          <a href="{{ route('login') }}">{{__('auth.login')}}</a>
        </div>
        <div class="r-signup-button {{ Route::currentRouteName() === 'register' ? 'active-auth-button' : '' }}">
          <a href="{{ route('register') }}">{{__('auth.register')}}</a>
        </div>
      </div>
    </div>
    <div class="register-form-wrapper">
      <div class="login-top">
        <div class="login-top-items">
          <span class="login-top-span">Регистрация</span>
        </div>
      </div>
      <div class="login-middle">
        <form action="{{ route('register') }}" method="POST" class="register-form">
          @csrf
          <div class="form-group">
            <label for="name" class="input-label">Имя</label>
            <input type="text" id="name" class="form-control form-input" name="name" value="{{ old('name') }}" />
            @error('name')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email" class="input-label">Ваш e-mail</label>
            <input
              type="email"
              class="form-control form-input"
              name="email"
              value="{{ old('email') }}"
            />
            @error('email')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group password-group">
            <label for="password" class="input-label">Пароль</label>
            <input type="password" id="password" class="form-control form-input" name="password" />
            <i class="fas fa-eye show-password-icon"></i>
            @error('password')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="phone_number" class="input-label">Номер телефона</label>
            <input type="text" id="phone_number" class="form-control form-input" name="phone_number"value="{{ old(
              'phone_number'
            ) }}" />
            @error('phone_number')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="type">тип</label>
            <div class="type-wrapper">
            <input class="user-type" type="radio" name="type" value="benefactor"/> Benefactor
            </div>
            <div class="type-wrapper">
            <input class="user-type" type="radio" name="type" value="user"/> User
            </div>
            @error('type')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="input-group interesting-types-group-div">
            <label for="types-list" class="input-label interesting-types-label">Area Of Interesting</label>
          </div>

          <div class="form-group additional-types">
            <label for="child-types" class="input-label child-types-label">Additional Type</label>
            <select name="additional_type" class="form-control form-input child-types-select" id="child-types-list">
              <option value="" disabled selected>Select Type</option>
              <option value="individual">Individual</option>
              <option value="organisation">Organisation</option>
            </select>
            @error('additional_type')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group organisation-div">
            <label for="organisation" class="input-label organisation-label">Organisation Description</label>
            <textarea name="organisation_description" class="form-control text-area-form-input organisation-input" id="organisation" cols="30" rows="10"></textarea>
            @error('organisation_description')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <button class="form-btn">Register</button>
        </form>
      </div>
    </div>
  </div> --}}

  <div class="god-container">
    <div class="r-super-container1">
      <h2 class="title-h2">Welcome Back!</h2>

      <div class="container-p">
        <p class="r-subtitle-p">
          To keep connected with us please login with your personal info.
        </p>

        <div class="div-button1">
          <a class="button1" href="{{ route('login') }}">Log in</a>
        </div>
      </div>
    </div>

    <br />
    <div class="super-container2">
      <div class="title-container">
        <h1>Create an account</h1>
      </div>
      <!-- <div class="buttons-login">
        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="#"><i class="fab fa-google fa-2x"></i></a>
        <a href="#"><i class="fab fa-twitter-square fa-2x"></i></a>
      </div> -->
      {{-- <div class="container-p">
        <p class="request-data">or us an e-mail for registration</p>
      </div> --}}
      <div class="form">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="input-div">
            <label for="name"></label>
            <input type="text" name="name" placeholder="Name" />
          </div>
          @error('name')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div">
            <label for="email"></label>
            <input type="email" name="email" id="" placeholder="E-mail" />
          </div>
          @error('email')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div password-group">
            <label for="password"></label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
            />
            <i class="fas fa-eye show-password-icon"></i>

          </div>
          @error('password')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div">
            <input
              id="phone_number"
              type="text"
              name="phone_number"
              placeholder="phone number"
            />
          </div>
          @error('phone_number')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="type-group">
            <label for="type">тип</label>
            <div class="type-wrapper">
              <input
                type="radio"
                class="user-type"
                name="type"
                value="benefactor"
              />
              Benefactor
            </div>
            <div class="type-wrapper">
              <input
                type="radio"
                class="user-type"
                name="type"
                value="user"
              />
              User
            </div>
          </div>
          @error('type')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div interests-group interesting-types-group-div">
            <label
              for="types-list"
              class="input-label interesting-types-label"
              >Area Of Interesting</label
            >
          </div>
          @error('interesting_type')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div additionals-group">
            <label for="child-types" class="input-label child-types-label"
              >Additional Type</label
            >
            <select
              name="additional_type"
              class="child-types-select"
              id="child-types-list"
            >
              <option value="" disabled selected>Select Type</option>
              <option value="individual">Individual</option>
              <option value="organisation">Organisation</option>
            </select>
          </div>
          @error('additional_type')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div organisation-div">
            <label for="organisation" class="input-label organisation-label">Organisation Description</label>
            <textarea name="organisation_description" class="organisation-input" id="organisation" cols="30" rows="10"></textarea>
            @error('organisation_description')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          <div class="button">
            <input class="button2" type="button" value="Sign up" />
          </div>
        </form>
      </div>
      
    </div>
  </div>
@push('js')
<script src="{{ asset('js/authentication.js') }}"></script>
@endpush
@endsection
