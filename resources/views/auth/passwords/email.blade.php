@extends('layouts.auth')
@section('title')
Forgot Your Password
@endsection
@section('content')
  <div class="main-page-button-wrapper">
    <a href="{{ route('welcome') }}">@lang('translations.home')</a>
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
        <h1>@lang('translations.reset-password')</h1>
      </div>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
            @lang('translations.reset-success')
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="register-form">
          @csrf
          <div class="input-div">
            <label for="email"></label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="E-mail" />
          </div>
            @error('email')
            <span class="error-span">{{ $message }}</span>
            @enderror
          
          <button class="resetbutton">@lang('translations.reset-button')</button>
        </form>

    </div>
  </div>
@endsection

