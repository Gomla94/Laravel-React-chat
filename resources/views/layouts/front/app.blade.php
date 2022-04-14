<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/newest-index.css')}}" />
    @yield('styles')
    <script src="{{asset('js/newest-index.js')}}" defer></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    window.uuxyz = <?php echo json_encode([
            'uuxyzd' => Auth::check() ? base64_encode(auth()->user()->id) : null,
            'uuxyzt' => Auth::check() ? base64_encode(auth()->user()->api_token) : null,
            'uuxyzq' => Auth::check() ? base64_encode(auth()->user()->unique_id) : null,
          ]);
      ?>
      </script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <title>@yield('title')</title>
  </head>
  <body>
    <div class="sec-navbar-wrapper">
      <div class="navbar">
        <div class="menu-bars" id="menu-bars">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <div class="navbar-logo-wrapper">
          <div class="navbar-links-wrapper">
            <ul class="navbar-links-list">
              <li class="navbar-link"><a class="{{ Route::currentRouteName() == 'all-users' ? 'navbar-active-item' : '' }}" href="{{ route('all-users') }}">{{ __('translations.users') }}</a></li>
            </ul>
        </div>
        </div>

        <div class="navbar-user-section-wrapper">
          @if(Auth::check())
          <div class="navbar-chat-icon">
            <a href="{{ route('user.chat') }}"><i class="fa-regular fa-comment"></i></a><span><a href="{{ route('user.chat') }}">{{ __('translations.chat') }}</a></span>
          </div>
          <div class="navbar-user-list">
            <div class="navbar-user-image-wrapper">
              <a href="#">
                <img src="{{ asset(auth()->user()->image ?? 'images/avatar.png') }}" alt="user-image" />
              </a>
            </div>
            <a href="#">
              <span class="navbar-user-name">{{ auth()->user()->name }}</span>
            </a>
            <i class="fa-solid fa-angle-down user-navbar-arrow"></i>
          </div>
          <div class="user-adds-list">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit">{{ __('translations.log_out') }}</button>
            </form>
          </div>
            @else
                <div class="login-navbar-user">
                    <a href="{{ route('login') }}">
                        <button class="login-navbar-user-btn">{{ __('translations.log_in') }}</button>
                    </a>
                </div>
            @endif
        
        </div>
      </div>
      <div class="overlay" id="overlay">
        <ul class="overlay-list">
          
          <li class="overlay-list-item">
            <a rel="preconnect" href="{{ route('all-users') }}">{{ __('translations.users') }}</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          @if(Auth::check())
            <li class="overlay-list-item">
              <a href="{{ route('user.chat') }}"><i class="fa-regular fa-comment"></i></a><span><a href="{{ route('user.chat') }}">{{ __('translations.chat') }}</a></span>
            </li>
          @endif
          @if(Auth::check())
            <li class="overlay-list-item">
              <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="mobile-logut-button">{{ __('translations.log_out') }}</button>
            </form>
            </li>
          @endif
        </ul>
      </div>

    </div>

   @yield('content')

   @stack('js')

  </body>
</html>
