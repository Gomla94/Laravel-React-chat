@extends('layouts.auth')
@section('title') Magaxat | Register @endsection
@section('content')
<div class="register-container">
    <div class="register-wrapper">
        <div class="login-titles">
        <p class="login-l-heading">Welcome Back</p>
        <p class="login-m-heading">Sign in</p>
        </div>

        <div class="register-form-wrapper">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">First Name</label>
                        <input
                            type="text"
                            class="login-email-input"
                            name="name"
                            placeholder="Name"
                            value="{{ old('name') }}"
                        />
                        @error('name')
                            <span class="auth-error-message">{{ $message }}</span>
                        @enderror

                        </div>

                        <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                        <input
                            type="text"
                            class="login-email-input"
                            name="last_name"
                            placeholder="Last name"
                            value="{{ old('last_name') }}"
                        />
                        @error('last_name')
                            <span class="auth-error-message">{{ $message }}</span>
                        @enderror
                        </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="login-email-input"
                            name="email"
                            placeholder="Email"
                            value="{{ old('email') }}"
                        />
                        @error('email')
                            <span class="auth-error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="login-email-input"
                            name="password"
                            placeholder="Password"
                        />
                        @error('password')
                            <span class="auth-error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <button class="register-button" type="submit">{{ __('translations.sign') }}</button>
            <p>or</p>
            <a href="{{ route('login') }}" class="register-goto-login-in">{{ __('translations.login') }}</a>
        </form>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('js/authentication.js') }}"></script>
@endpush
@endsection
