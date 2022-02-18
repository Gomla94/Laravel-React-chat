<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('meta-description')
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/dark-logo.jpeg') }}" />
    <title>Magaxat</title>
    <link rel="stylesheet" href="{{asset('css/newStyle.css?version=6')}}" />
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script> --}}


    @yield('css')

    @if(Auth::check())
    <script src="{{ asset('js/app.js?version=11') }}" defer></script>
    @endif

    @if(!Auth::check())
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @endif

    <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
    <script src="{{asset('js/newIndex.js?version=5')}}" defer></script>

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
       <li class="overlay-list-item">
        <a rel="preconnect" href="{{ route('all-videos') }}">@lang('translations.users_video')</a>
       </li>
        <li class="overlay-list-item">
        <a rel="preconnect" href="{{ route('all-users') }}">@lang('translations.users')</a>
        </li>
        <li class="overlay-list-item">
          <a rel="preconnect" href="{{ route('all-benefactors') }}">@lang('translations.benefac_fond')</a>
        </li>
        <li class="overlay-list-item">
          <a rel="preconnect" href="{{ route('all-benefactors') }}">@lang('translations.benefac')</a>
        </li>
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
            <a rel="preconnect" href="{{ route('welcome') }}"
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
                >@lang('translations.users_video')</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-users') }}"
                class="{{ Route::currentRouteName() == 'all-users' ? 'active-list-item' : 'list-item' }}"
                >@lang('translations.users')</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-appeals') }}"
                class="{{ Route::currentRouteName() == 'all-appeals' ? 'active-list-item' : 'list-item' }}"
                >@lang('translations.benefac_fond')</a
              >
            </div>
            <div class="nav-item">
              <a
                href="{{ route('all-benefactors') }}"
                class="{{ Route::currentRouteName() == 'all-benefactors' ? 'active-list-item' : 'list-item' }}"
                >@lang('translations.benefac')</a
              >
            </div>
          </div>
        </div>

        <div class="">
        @if(Auth::check())
          <div class="navbar-user-containerr">
            <div class="navbar-language-item">
              <div class="language">
                  @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
                <div class="lang-image-wrapper">
                  <img class="lang-image" src="{{ asset('images/armenia-square.png') }}" />
                </div>
                  @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
                      <div class="lang-image-wrapper">
                          <img class="lang-image" src="{{ asset('images/uk-square.png') }}" />
                      </div>
                  @else
                      <div class="lang-image-wrapper">
                          <img class="lang-image" src="{{ asset('images/russia-square.png') }}" />
                      </div>
                  @endif
              </div>
              <div class="language-list">
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                     @if($localeCode == 'en')
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/uk-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @elseif($localeCode == 'ru')
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/russia-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @else
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/armenia-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @endif
                  @endforeach
              </div>
            </div>
            @if(Auth::id())
            <div id="root"></div>
            @endif

            @if(Auth::id())
            <div id="root-notifications"></div>
            @endif

            @if(Auth::check())
            <div class="navbar-user-name">
              <a href="{{ route('user.profile') }}">
              {{ auth()->user()->name }}
              </a>
              </div>
            <div class="navbar-user-image-container">
              <a rel="preconnect" href="{{ route('user.profile') }}"
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
                >@lang('translations.my_profile')</a
              >
              <form action={{ route('logout') }} method="POST" class="logout-form">
                @csrf
                <a href="#" class="user-navbar-list-item logout">@lang('translations.log_out')</a>
                </form>
            </div>
            @else
            <a rel="preconnect" href="{{ route('login') }}">@lang('translations.log_in')</a>
            @endif
          </div>
        @else
          <div class="login-navbar-user-containerr">
            <div class="navbar-language-item">
              <div class="language">
                  @if(LaravelLocalization::getCurrentLocaleName() == 'Armenian')
                <div class="lang-image-wrapper">
                  <img class="lang-image" src="{{ asset('images/armenia-square.png') }}" />
                </div>
                  @elseif(LaravelLocalization::getCurrentLocaleName() == 'English')
                      <div class="lang-image-wrapper">
                          <img class="lang-image" src="{{ asset('images/uk-square.png') }}" />
                      </div>
                  @else
                      <div class="lang-image-wrapper">
                          <img class="lang-image" src="{{ asset('images/russia-square.png') }}" />
                      </div>
                  @endif
              </div>
              <div class="language-list">
                  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                     @if($localeCode == 'en')
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/uk-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @elseif($localeCode == 'ru')
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/russia-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @else
                     <div class="language">
                         <div class="lang-image-wrapper">
                             <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                             <img class="lang-image" src="{{ asset('images/armenia-square.png') }}" />
                             </a>
                         </div>
                     </div>
                     @endif
                  @endforeach
              </div>
            </div>
            <a rel="preconnect" href="{{ route('login') }}">@lang('translations.log_in')</a>
          </div>
        @endif
        </div>
      </div>
    </div>

    <div class="main">
        @yield('content')
    </div>


    @stack('js')
  </body>
</html>
