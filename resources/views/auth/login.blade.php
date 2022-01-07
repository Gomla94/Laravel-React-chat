@extends('layouts.auth')
@section('title')
Login
@endsection
@section('content')
  <div class="main-page-button-wrapper">
    <a href="{{ route('welcome') }}">Home</a>
  </div>
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
