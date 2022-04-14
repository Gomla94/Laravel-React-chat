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
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/newest-index.css')}}" />
    <link rel="stylesheet" href="{{asset('css/new-authentication.css')}}" />
    <script src="{{asset('js/newest-index.js')}}" defer></script>
    <title>@yield('title')</title>
  </head>
  <body>
      <div class="navbar">
        <div class="menu-bars" id="menu-bars">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      </div>
      <div class="overlay" id="overlay">
        <ul class="overlay-list">
          <li class="overlay-list-item">
            <a rel="preconnect" href="{{ route('all-users') }}">Users</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <i class="fa-regular fa-comment"></i><span>Chat</span>
          </li>
        </ul>
      </div>
   
      
     
    @yield('content')

    @stack('js')
  </body>
</html>
