<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />

    @yield('css')

    <script src="{{asset('js/index.js')}}" defer></script>
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
        <li class="overlay-list-item">Благотварители</li>
        <li class="overlay-list-item">Контакты</li>
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
        <a href="{{ route('all-videos') }}"><li class="list-item">Видео пользователей</li></a>
        <a href="{{ route('all-users') }}"><li class="list-item">Пользователи</li></a>
        <a href="{{ route('all-benefactors') }}"><li class="list-item">Благотворительный фонд</li></a>
        <li class="list-item">Благотварители</li>
        <li class="list-item">Контакты</li>
      </ul>

      <div class="user-section">
        @if(Auth::id())
          <div id="root"></div>
        @endif
        @if(Auth::check())
        <p class="title">{{ auth()->user()->name }}</p>
        <img src="{{asset('images/avatar.png')}}" class="user-image" alt="" />
        <i class="arrow fas fa-chevron-down user-arrow-down"></i>
        <div class="user-navbar-list">
          <form action={{ route('logout') }} method="POST" class="logout-form">
            @csrf
            <a href="#" class="user-navbar-list-item">User Profile</a>
          </form>
          <a href="#" class="user-navbar-list-item logout">Logout</a>
        </div>
        @else 
        <a href="{{ route('login') }}">Login</a>
        @endif
      </div>
      
    </div>
    @yield('content')
    
    
    @stack('js')
  </body>
</html>
