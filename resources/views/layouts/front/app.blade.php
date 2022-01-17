{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="{{ asset('images/dark-logo.jpeg') }}" />
    <title>
      Magaxat
    </title>

    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <link
    rel="stylesheet"
    href="https://unpkg.com/swiper/swiper-bundle.min.css"
  />

    @yield('css')
    @if(Auth::check())
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    <script src="{{asset('js/index.js')}}" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
      window.Laravel = <?php echo json_encode([
              'csrfToken' => Csrf_token(),
              'user' => Auth::check() ? auth()->user() : null,
          ]);
      ?>
  </script>

  </head>
  <body>
    <div class="overlay" id="overlay">
      <ul class="overlay-list">
        <a href="{{ route('all-videos') }}"><li class="overlay-list-item">Видео пользователей</li></a>
          <a href="{{ route('all-users') }}"><li class="overlay-list-item">Пользователи</li></a>
          <a href="{{ route('all-benefactors') }}"><li class="overlay-list-item">Благотворительный фонд</li></a>
          <a href="{{ route('all-benefactors') }}"><li class="overlay-list-item">Благотварители</li></a>
      </ul>
    </div>
    <div class="navbar">
      <div class="menu-bars" id="menu-bars">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </div>

      <div class="logo">
        <a href="{{ route('welcome') }}"><img src="{{asset('images/dark-logo.jpeg')}}" class="logo-image" alt="" /></a>
      </div>
      <ul class="navbar-list">
        <a href="{{ route('all-videos') }}"><li class="{{ Route::currentRouteName() == 'all-videos' ? 'active-list-item' : 'list-item' }}">Видео пользователей</li></a>
        <a href="{{ route('all-users') }}"><li class="{{ Route::currentRouteName() == 'all-users' ? 'active-list-item' : 'list-item' }}">Пользователи</li></a>
        <a href="{{ route('all-appeals') }}"><li class="{{ Route::currentRouteName() == 'all-appeals' ? 'active-list-item' : 'list-item' }}">Благотворительный фонд</li></a>
        <a href="{{ route('all-benefactors') }}"><li class="{{ Route::currentRouteName() == 'all-benefactors' ? 'active-list-item' : 'list-item' }}">Благотварители</li></a>
      </ul>

      <div class="user-section">
        @if(Auth::id())
          <div id="root"></div>
        @endif
        @if(Auth::check())
        <p class="title">{{ auth()->user()->name }}</p>
        <a href="{{ route('user.page', auth()->user()->id) }}"><img src="{{asset('images/avatar.png')}}" class="user-image" alt="" /></a>
        <i class="arrow fas fa-chevron-down user-arrow-down"></i>
        <div class="user-navbar-list">
          <a href="{{ route('user.profile') }}" class="user-navbar-list-item">User Profile</a>
          <form action={{ route('logout') }} method="POST" class="logout-form">
            @csrf
            <a href="#" class="user-navbar-list-item logout">Logout</a>
            </form>
        </div>
        @else
        <a href="{{ route('login') }}">Login</a>
        @endif
      </div>

    </div>
    <div class="main">
    @yield('content')
    </div>

    @stack('js')

  </body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/dark-logo.jpeg') }}" />
    <title>Magaxat</title>
    <link rel="stylesheet" href="{{asset('css/newStyle.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>

    @yield('css')

    @if(Auth::check())
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    @if(!Auth::check())
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @endif

    <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
    <script src="{{asset('js/newIndex.js')}}" defer></script>

    <script>
      window.Laravel = <?php echo json_encode([
              'csrfToken' => Csrf_token(),
              'user' => Auth::check() ? auth()->user() : null,
          ]);
      ?>
  </script>
  </head>
  <body>
  <style>
      body {
          background-image: url("{{asset("images/bg.jpg")}}");
          background-size: cover;
      }
  </style>
    <div class="overlay" id="overlay">
      <ul class="overlay-list">
        <a href="{{ route('all-videos') }}"
          ><li class="overlay-list-item">Видео пользователей</li></a
        >
        <a href="{{ route('all-users') }}"
          ><li class="overlay-list-item">Пользователи</li></a
        >
        <a href="{{ route('all-benefactors') }}"
          ><li class="overlay-list-item">Благотворительный фонд</li></a
        >
        <a href="{{ route('all-benefactors') }}"
          ><li class="overlay-list-item">Благотварители</li></a
        >
      </ul>
    </div>
    <div class="main-navbar">
      <div class="navbar-wrapper">
        <div class="col-md-1 col-sm-1 menu-bars-wrapper">
          <div class="menu-bars" id="menu-bars">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
          <div class="navbar-logo-container">
            <a href="{{ route('welcome') }}"
              ><img
                src="{{asset('images/dark-logo.jpeg')}}"
                class="navbar-logo"
                alt=""
            /></a>
          </div>
        </div>
        <div class="col-md-8 col-sm-8 navbar-links-wrapper">
          <div class="navbar-links-container">
            <div class="nav-item">
              <a
                href="{{ route('all-videos') }}"
                class="{{ Route::currentRouteName() == 'all-videos' ? 'active-list-item' : 'list-item' }}"
                >Видео пользователей</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-users') }}"
                class="{{ Route::currentRouteName() == 'all-users' ? 'active-list-item' : 'list-item' }}"
                >Пользователи</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-appeals') }}"
                class="{{ Route::currentRouteName() == 'all-appeals' ? 'active-list-item' : 'list-item' }}"
                >Благотворительный фонд</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-benefactors') }}"
                class="{{ Route::currentRouteName() == 'all-benefactors' ? 'active-list-item' : 'list-item' }}"
                >Благотварители</a
              >
            </div>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
          <div class="navbar-user-container">
            @if(Auth::id())
            <div id="root"></div>
            @endif

            @if(Auth::check())
            <div class="navbar-user-name">{{ auth()->user()->name }}</div>
            <div class="navbar-user-image-container">
              <a href="{{ route('user.profile') }}"
                ><img
                  src="{{asset(auth()->user()->image ?? 'images/avatar.png')}}"
                  alt="user-image"
                  class="navbar-user-image"
              /></a>
            </div>
            <div>
              <i class="fas fa-chevron-down user-navbar-arrow-down"></i>
            </div>
            <div class="user-navbar-list">
              <a
                href="{{ route('user.profile') }}"
                class="user-navbar-list-item"
                >My Profile</a
              >
              <form action={{ route('logout') }} method="POST" class="logout-form">
                @csrf
                <a href="#" class="user-navbar-list-item logout">Logout</a>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}">Login</a>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="main">
        @yield('content')
    </div>


    @stack('js')

    <!-- <script>
      var swiper = new Swiper(".swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script> -->
  </body>
</html>
