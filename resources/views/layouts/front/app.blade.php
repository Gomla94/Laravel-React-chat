<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />

    <script src="{{asset('js/index.js')}}" defer></script>
  </head>
  <body>
    <div class="overlay" id="overlay">
      <ul class="overlay-list">
        <li class="overlay-list-item">Видео пользователей</li>
        <li class="overlay-list-item">Пользователи</li>
        <li class="overlay-list-item">Благотворительный фонд</li>
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
        <img src="{{asset('images/dark-logo.jpeg')}}" class="logo-image" alt="" />
      </div>
      <ul class="navbar-list">
        <li class="list-item">Видео пользователей</li>
        <li class="list-item">Пользователи</li>
        <li class="list-item">Благотворительный фонд</li>
        <li class="list-item">Благотварители</li>
        <li class="list-item">Контакты</li>
      </ul>
      <div class="user-section">
        <i class="far fa-comments"></i>
        <p class="title">Анастасия</p>
        <img src="{{asset('images/avatar.png')}}" class="user-image" alt="" />
        <i class="arrow fas fa-chevron-down"></i>
      </div>
    </div>
    <div class="chat-wrapper">
        <div class="active-users-section">
            <div class="active-users-top-section">
                <div class="sound-check-background"></div>
                <div class="sound-checker"></div>
                <span class="check-sound">Звук</span>
            </div>
            <div class="active-users">
                <div class="active-users-search-wrapper">
                    <i class="fas fa-search active-users-search"></i>
                    <i class="fas fa-window-close"></i>
                    <input class="active-users-input" placeholder="Поиск по кантактам" type="text"/>
                </div>
                <div class="active-users-list-wrapper">
                    <ul class="active-users-list">
                        <li class="active-user">
                            <div class="bell-icon-wrapper" alt=""></div>
                            <i class="fas fa-bell"></i>
                            <div class="chat-user-name">Техподдержка</div>
                        </li>
                        <li class="active-user">
                            <div class="bell-icon-wrapper" alt=""></div>
                            <i class="fas fa-cog"></i>   
                            <div class="chat-user-name">Техподдержка</div>                         
                        </li>
                        <li class="active-user">
                            <div class="bell-icon-wrapper" alt=""></div>
                            <i class="fas fa-cog"></i> 
                            <div class="chat-user-name">Техподдержка</div>                           
                        </li>
                        <li class="active-user">
                            <img src="{{asset('images/Ellipse 14.png')}}" class="active-user-img" alt="">
                            <div class="chat-user-name">Техподдержка</div>
                        </li>
                        <li class="active-user">
                            <img src="{{asset('images/Ellipse 14.png')}}" class="active-user-img" alt="">
                            <div class="chat-user-name">Техподдержка</div>
                        </li>
                        <li class="active-user">
                            <img src="{{asset('images/Ellipse 14.png')}}" class="active-user-img" alt="">
                            <div class="chat-user-name">Техподдержка</div>
                        </li>
                        <li class="active-user">
                            <img src="{{asset('images/Ellipse 14.png')}}" class="active-user-img" alt="">
                            <div class="chat-user-name">Техподдержка</div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="messages-section">
            <div class="messages-section-top"></div>
            <div class="messages-section-bottom">
                <div class="attachement-wrapper">
                    <i class="fas fa-paperclip"></i>
                </div>
                <input class="message-input" placeholder="Напишите здесь свой текст ..." type="text">
                <div class="video-wrapper">
                    <i class="fas fa-photo-video"></i>
                </div>
                <div class="image-wrapper">
                    <i class="fas fa-images"></i>
                </div>
                <div class="send-wrapper">
                    <i class="fas fa-paper-plane"></i>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    
    
    @stack('js')
  </body>
</html>
