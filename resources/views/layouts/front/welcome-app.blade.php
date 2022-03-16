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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/newest-index.css?version=10')}}" />
    @yield('styles')
    <script src="{{asset('js/newest-index.js?version=2')}}" defer></script>
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

    <title>Magaxat | Home</title>
  </head>
  <body>
    <div class="navbar-wrapper">
      <div class="navbar">
        <div class="menu-bars" id="menu-bars">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <div class="navbar-logo-wrapper">
          <a href="{{ route('welcome') }}">
            <img src="{{asset('images/img/navbar-logo.png')}}" alt="" class="navbar-logo" />
          </a>
        </div>
        <div class="navbar-links-wrapper">
          <ul class="navbar-links-list">
            <li><a class="{{ Route::currentRouteName() == 'all-videos' ? 'navbar-active-item' : '' }}" href="{{ route('all-videos') }}">User Videos</a></li>
            <li><a class="{{ Route::currentRouteName() == 'all-users' ? 'navbar-active-item' : '' }}" href="{{ route('all-users') }}">Users</a></li>
            <li><a class="{{ Route::currentRouteName() == 'all-appeals' ? 'navbar-active-item' : '' }}" href="{{ route('all-appeals') }}">Benefactor Fonds</a></li>
            <li><a class="{{ Route::currentRouteName() == 'all-benefactors' ? 'navbar-active-item' : '' }}" href="{{ route('all-benefactors') }}">Benefactors</a></li>
          </ul>
        </div>
        <div class="navbar-user-section-wrapper">
          @if(Auth::check())
          <div class="navbar-chat-icon">
            <i class="fa-regular fa-comment"></i><span>Chat</span>
          </div>
          <div class="navbar-user-list">
            <div class="navbar-user-image-wrapper">
              <a href="{{ route('user.profile') }}">
                <img src="{{ asset(auth()->user()->image ?? 'images/avatar.png') }}" alt="user-image" />
              </a>
            </div>
            <span class="navbar-user-name">{{ auth()->user()->name }}</span>
            <i class="fa-solid fa-angle-down user-navbar-arrow"></i>
          </div>
          <div class="user-adds-list">
            <form action="{{ route('logout') }}" method="POST">
              @csrf  
              <button type="submit">Logout</button>
            </form>
          </div>
          @else
          <div class="login-navbar-user">
            <span class="navbar-user-name">
              <a href="{{ route('login') }}">Login</a>
            </span>
          </div>
          @endif
          <div class="navbar-languages-list">
            
            @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
              <span>ARM</span>
              <i class="fa-solid fa-angle-down languages-icon"></i>
            @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
              <span>ENG</span>
              <i class="fa-solid fa-angle-down languages-icon"></i>
            @else
              <span>RUS</span>
            <i class="fa-solid fa-angle-down languages-icon"></i>
            @endif

          </div>
          <div class="languages-list">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              @if($localeCode == 'en')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ENG</a>
              </div>
              @elseif($localeCode == 'ru')
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">RUS</a>
              </div>
              @else
              <div class="language-item-wrapper">
                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">ARM</a>
              </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
      <div class="overlay" id="overlay">
        <ul class="overlay-list">
          <li class="overlay-list-item">
            <img src="{{asset('images/img/video-clips.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-videos') }}">User Videos</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/users.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-users') }}">Users</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/benefactor-fonds.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-appeals') }}">Benefactor Fonds</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <img src="{{asset('images/img/benefactor.png')}}" alt="" />
            <a rel="preconnect" href="{{ route('all-benefactors') }}">Benefactors</a>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <span rel="preconnect" href="">Eng</span>
            <span rel="preconnect" href="">Language</span>
            <i class="fa-solid fa-angle-right"></i>
          </li>
          <li class="overlay-list-item">
            <i class="fa-regular fa-comment"></i><span>Chat</span>
          </li>
        </ul>
      </div>
      <div class="swiper myMainSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="{{asset('images/img/slider-1.png')}}" alt="sliderone" />
            <p class="slider-text">
              As well as diluted with a fair amount of empathy, rational
              thinking largely determines the importance of the positions taken
              by the participants in relation to the tasks assigned. As is
              commonly believed, interactive prototypes are only a method of
              political participation and are associatively distributed across
              industries.
            </p>
          </div>
          <div class="swiper-slide">
            <img src="{{asset('images/img/slider-2.png')}}" alt="slidertwo" />
            <p class="slider-text">
              As well as diluted with a fair amount of empathy, rational
              thinking largely determines the importance of the positions taken
              by the participants in relation to the tasks assigned. As is
              commonly believed, interactive prototypes are only a method of
              political participation and are associatively distributed across
              industries.
            </p>
          </div>
          <div class="swiper-slide">
            <img src="{{asset('images/img/slider-3.png')}}" alt="sliderthree" />
            <p class="slider-text">
              As well as diluted with a fair amount of empathy, rational
              thinking largely determines the importance of the positions taken
              by the participants in relation to the tasks assigned. As is
              commonly believed, interactive prototypes are only a method of
              political participation and are associatively distributed across
              industries.
            </p>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

   @yield('content')

   @stack('js')
    <script>
      var swiper = new Swiper(".myMainSwiper", {
        spaceBetween: 30,
        autoplay: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
      var swiper2 = new Swiper(".appealsSwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          1100: {
            slidesPerView: 3,
          },

          768: {
            slidesPerView: 2,
          },

          500: {
            slidesPerView: 1,
          },

          300: {
            slidesPerView: 1,
          },
        },
      });
    </script>
  </body>
</html>
