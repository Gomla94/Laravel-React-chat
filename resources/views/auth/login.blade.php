@extends('layouts.auth')
@section('title') @lang('translations.login') @endsection
@section('content')

    <div class="main-page-button-wrapper">
        <a href="{{ route('welcome') }}" class="containers">
            <img class="box-logo"
                 src="{{asset('images/dark-logo.jpeg')}}"/>
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
                    <a class="custom-btn btn-7 mb-5" href="{{ route('register') }}"
                       style="text-decoration: none"><span>@lang('translations.sign')</span></a>
                </div>
            </div>
        </div>

        <br/>
        <div class="super-container2">
            <div class="title-container mt-1">
                <h1>@lang('translations.login')</h1>
            </div>
            <div class="form mt-3">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-div">
                        <label for="email"></label>
                        <input type="email" name="email" value="{{ old('email') }}" id="email"
                               placeholder="@lang('translations.e_mail')"/>
                    </div>
                    @error('email')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-div">
                        <label for="password"></label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="@lang('translations.password')"
                        />
                    </div>
                    @error('password')
                    <div class="input-error mb-3">
                        {{$message}}
                    </div>
                    @enderror
                    <a class="forgot-link text-with-hover"
                       href="{{route('password.request')}}">@lang('translations.forgot-password')</a>
                    <div class="button">
                        <button class="custom-btn btn-7 mb-5"><span>@lang('translations.login')</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
