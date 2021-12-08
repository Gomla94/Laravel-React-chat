@extends('layouts.auth')
@section('title')
Reset Your Password
@endsection
@section('content')
<div class="reset-password-container">
  <div class="btns-wrapper"></div>
  <div class="login-wrapper">
    <div class="login-container">
      <div class="register-top">
        <div class="login-top-items">
          <span class="login-top-span">восстановите вашу страницу с паролем</span>
        </div>
      </div>
      <div class="register-middle">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            Мы отправили вашу новую ссылку пароля
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="register-form">
          @csrf
          <div class="input-group">
            <label for="name" class="input-label">Ваш e-mail</label>
            <input type="text" id="name" class="form-input" name="email" value="{{ old('email') }}" />
            @error('email')
              <span style="color:red">{{$message}}</span>
            @enderror
          </div>
          
          <button class="form-btn">отправить электронное письмо для сброса пароля</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
<script src="{{ asset('js/authentication.js') }}"></script>
@endpush
@endsection
{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endsection --}}
