@extends('layouts.auth')
@section('title')
Register
@endsection
@section('content')
  <div class="main-page-button-wrapper">
    <a href="{{ route('welcome') }}">Home</a>
  </div>
  <div class="r-god-container">
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
    <div class="r-super-container2">
      <div class="title-container">
        <h1>Create an account</h1>
      </div>

      <div class="form">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="input-div">
            <label for="name"></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name" />
          </div>
          @error('name')
            <span style="color:red">{{$message}}</span>
          @enderror
          <div class="input-div">
            <label for="email"></label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="E-mail" />
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
              value="{{ old('phone_number') }}"
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
            <button class="button2">Sign up</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
@push('js')
<script src="{{ asset('js/authentication.js') }}"></script>
@endpush
@endsection
