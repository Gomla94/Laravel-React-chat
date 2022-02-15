@extends('layouts.auth')
@section('title')
    @lang('translations.forgot_password')
@endsection
@section('content')
    <div class="main-page-button-wrapper">
        <a href="{{ route('welcome') }}" class="containers">
            <img class="box-logo"
                 src="{{asset('images/dark-logo.jpeg')}}"
            />
            <div class="box-shadow"></div>
        </a>
    </div>
  <div class="god-container">
    <div class="super-container1">
      <h2 class="title-h2">@lang('translations.welcm')</h2>

      <div class="container-p">
        <p class="subtitle-p">
          @lang('translations.inf')
        </p>

        <div class="div-button1">
          <a class="custom-btn btn-7 mb-5" style="text-decoration: none" href="{{ route('register') }}"><span>@lang('translations.sign')</span></a>
        </div>
      </div>
    </div>

    <br />
    <div class="super-container2">
      <div class="title-container mt-3">
        <h1>@lang('translations.reset-password')</h1>
      </div>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
            @lang('translations.reset-success')
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="register-form">
          @csrf
          <div class="input-div mt-5">
            <label for="email"></label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="@lang('translations.e_mail')" />
          </div>
            @error('email')
            <div class="input-error mb-3">
                {{$message}}
            </div>
            @enderror
          <button class="custom-btn btn-7 mb-5"><span>@lang('translations.reset-button')</span></button>
        </form>

    </div>
  </div>
@endsection

