@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the user {{ $user->name }} profile page">
@endsection
@section('title')
Magaxat | Profile
@endsection
@section('css')
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css"
/>
@endsection
@section('content')


<div class="profile-wrapper">
  <div class="container">
    <div class="profile-container">
      <div class="profile-header">
        <div class="profile-img">
          <img src="./img/person.png" width="200" alt="Profile Image" />
          <div class="change-profile-image-icon">
            <label for="profile-image-input" class="profile-image-label">
              <i class="fa-solid fa-camera"></i>
              <input
                type="file"
                class="profile-image-input"
                name=""
                id="profile-image-input"
              />
              <span>Change</span>
            </label>
          </div>
        </div>
      </div>

      <div class="main-bd">
        <div class="left-side">
          <div class="profile-side">
            <p class="profile-user-name">Eduard Gabrielyan</p>
            <p class="profile-icon-wrapper">
              <i class="fa fa-phone"></i> <span>+23470xxxxx700</span>
            </p>
            <p class="profile-icon-wrapper">
              <i class="fa fa-envelope"></i>
              <span>Brightisaac80@gmail.com</span>
            </p>
          </div>
        </div>
        <div class="right-side">
          <div class="nav">
            <ul>
              <li onclick="tabs(0)" class="profile-item user-post">
                Posts
              </li>
              <li onclick="tabs(1)" class="profile-item user-review">
                Reviews
              </li>
              <li onclick="tabs(2)" class="profile-item user-setting">
                Settings
              </li>
              <li onclick="tabs(3)" class="profile-item user-images">
                Images
              </li>
              <li onclick="tabs(4)" class="profile-item user-appeals">
                Appeals
              </li>
              <li onclick="tabs(5)" class="profile-item user-appeals">
                Appeals
              </li>
              <li onclick="tabs(6)" class="profile-item user-appeals">
                Appeals
              </li>
            </ul>
          </div>
          <div class="profile-body">
            <div class="profile-posts tab">
              <h1>Your Post</h1>
              <div class="profile-create-posts-wrapper">
                <div class="profile-create-posts-icon-wrapper">
                  <i class="fa-solid fa-plus"></i>
                </div>
                <p>Creat a Post</p>
              </div>
              <div class="profile-main-posts">
                <div class="main-post">
                  <div class="post-user-date-wrapper">
                    <div class="post-user-info">
                      <div class="post-user-image-wrapper">
                        <img src="./img/person.png" alt="person" />
                      </div>
                      <div class="profile-post-user-names-wrapper">
                        <span class="post-user-name"
                          >Eduard Gabrielyan</span
                        >
                        <span class="post-user-link"
                          >@eduard gabrielyan</span
                        >
                      </div>
                    </div>
                    <div class="post-date-wrapper">
                      <span class="post-date">2022-02-19</span>
                      <span class="post-time">07:18PM</span>
                    </div>
                  </div>
                  <p class="post-title">
                    Lorem ipsum dolor sit ametillo sit aliquam commodi
                    impedit odio nam. Delectus corrupti cumque eos libero
                    perferendis ut, illum quo eveniet nostrum.
                  </p>
                  <div class="post-image-wrapper">
                    <img
                      class="main-post-image"
                      src="./img/bg-video.png"
                      alt="post-image"
                    />
                  </div>
                  <p class="post-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ratione, minus error eius accusamus obcaecati culpa
                    nihil vitae excepturi facere et maiores soluta illo sit
                    aliquam commodi impedit odio nam. Delectus corrupti
                    cumque eos libero perferendis ut, illum quo eveniet
                    nostrum.
                  </p>
                  <div class="main-post-socials-wrapper">
                    <div class="likes-count">
                      <i class="fa-solid fa-heart social-icon"></i>
                      <span>123</span>
                    </div>
                    <div class="comments-count">
                      <i
                        class="fa-regular fa-comment social-icon main-post-comments-icon"
                      ></i>
                      <span>32</span>
                    </div>
                    <div class="shares-count">
                      <i class="fa-solid fa-share social-icon"></i>
                      <span>4</span>
                    </div>
                  </div>

                  <div class="main-post-comment-form-wrapper">
                    <form class="main-post-comment-form">
                      <div class="form-group">
                        <textarea
                          name="title"
                          class="form-control main-post-form-textarea"
                          id=""
                          cols="10"
                          rows="2"
                        ></textarea>
                      </div>
                      <div class="comment-error-div">
                        <span class="comment-error-span"></span>
                      </div>
                      <button
                        type="button"
                        class="main-post-add-comment-btn"
                      >
                        Add comment
                      </button>
                    </form>
                  </div>

                  <div class="main-post-comments-section">
                    <div id="comment" class="comment">
                      <div class="comment-date-wrapper">
                        <span class="comment-user-name">Ahmed Gamal</span>
                        <span class="comment-date"
                          >2/21/2022 10:39:03 AM</span
                        >
                      </div>
                      <p class="comment-body">hhahahahahaha</p>
                    </div>
                    <div id="comment" class="comment">
                      <div class="comment-date-wrapper">
                        <span class="comment-user-name">Ahmed Gamal</span>
                        <span class="comment-date"
                          >2/21/2022 10:39:03 AM</span
                        >
                      </div>
                      <p class="comment-body">hhahahahahaha</p>
                    </div>
                    <div id="comment" class="comment">
                      <div class="comment-date-wrapper">
                        <span class="comment-user-name">Ahmed Gamal</span>
                        <span class="comment-date"
                          >2/21/2022 10:39:03 AM</span
                        >
                      </div>
                      <p class="comment-body">hhahahahahaha</p>
                    </div>
                  </div>
                </div>
                <div class="main-post">
                  <div class="post-user-date-wrapper">
                    <div class="post-user-info">
                      <div class="post-user-image-wrapper">
                        <img src="./img/person.png" alt="person" />
                      </div>
                      <div class="profile-post-user-names-wrapper">
                        <span class="post-user-name"
                          >Eduard Gabrielyan</span
                        >
                        <span class="post-user-link"
                          >@eduard gabrielyan</span
                        >
                      </div>
                    </div>
                    <div class="post-date-wrapper">
                      <span class="post-date">2022-02-19</span>
                      <span class="post-time">07:18PM</span>
                    </div>
                  </div>
                  <p class="post-title">
                    Lorem ipsum dolor sit ametillo sit aliquam commodi
                    impedit odio nam. Delectus corrupti cumque eos libero
                    perferendis ut, illum quo eveniet nostrum.
                  </p>
                  <div class="post-image-wrapper">
                    <img
                      class="main-post-image"
                      src="./img/bg-video.png"
                      alt="post-image"
                    />
                  </div>
                  <p class="post-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ratione, minus error eius accusamus obcaecati culpa
                    nihil vitae excepturi facere et maiores soluta illo sit
                    aliquam commodi impedit odio nam. Delectus corrupti
                    cumque eos libero perferendis ut, illum quo eveniet
                    nostrum.
                  </p>
                  <div class="main-post-socials-wrapper">
                    <div class="likes-count">
                      <i class="fa-solid fa-heart social-icon"></i>
                      <span>123</span>
                    </div>
                    <div class="comments-count">
                      <i class="fa-regular fa-comment social-icon"></i>
                      <span>32</span>
                    </div>
                    <div class="shares-count">
                      <i class="fa-solid fa-share social-icon"></i>
                      <span>4</span>
                    </div>
                  </div>
                  <div class="main-post-comment-form-wrapper">
                    <form class="main-post-comment-form">
                      <div class="form-group">
                        <textarea
                          name="title"
                          class="form-control main-post-form-textarea"
                          id=""
                          cols="10"
                          rows="2"
                        ></textarea>
                      </div>
                      <div class="comment-error-div">
                        <span class="comment-error-span"></span>
                      </div>
                      <button
                        type="button"
                        class="main-post-add-comment-btn"
                      >
                        Add comment
                      </button>
                    </form>
                  </div>
                </div>
                <div class="main-post">
                  <div class="post-user-date-wrapper">
                    <div class="post-user-info">
                      <div class="post-user-image-wrapper">
                        <img src="./img/person.png" alt="person" />
                      </div>
                      <div class="profile-post-user-names-wrapper">
                        <span class="post-user-name"
                          >Eduard Gabrielyan</span
                        >
                        <span class="post-user-link"
                          >@eduard gabrielyan</span
                        >
                      </div>
                    </div>
                    <div class="post-date-wrapper">
                      <span class="post-date">2022-02-19</span>
                      <span class="post-time">07:18PM</span>
                    </div>
                  </div>
                  <p class="post-title">
                    Lorem ipsum dolor sit ametillo sit aliquam commodi
                    impedit odio nam. Delectus corrupti cumque eos libero
                    perferendis ut, illum quo eveniet nostrum.
                  </p>
                  <div class="post-image-wrapper">
                    <img
                      class="main-post-image"
                      src="./img/bg-video.png"
                      alt="post-image"
                    />
                  </div>
                  <p class="post-description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ratione, minus error eius accusamus obcaecati culpa
                    nihil vitae excepturi facere et maiores soluta illo sit
                    aliquam commodi impedit odio nam. Delectus corrupti
                    cumque eos libero perferendis ut, illum quo eveniet
                    nostrum.
                  </p>
                  <div class="main-post-socials-wrapper">
                    <div class="likes-count">
                      <i class="fa-solid fa-heart social-icon"></i>
                      <span>123</span>
                    </div>
                    <div class="comments-count">
                      <i class="fa-regular fa-comment social-icon"></i>
                      <span>32</span>
                    </div>
                    <div class="shares-count">
                      <i class="fa-solid fa-share social-icon"></i>
                      <span>4</span>
                    </div>
                  </div>
                  <div class="main-post-comment-form-wrapper">
                    <form class="main-post-comment-form">
                      <div class="form-group">
                        <textarea
                          name="title"
                          class="form-control main-post-form-textarea"
                          id=""
                          cols="10"
                          rows="2"
                        ></textarea>
                      </div>
                      <div class="comment-error-div">
                        <span class="comment-error-span"></span>
                      </div>
                      <button
                        type="button"
                        class="main-post-add-comment-btn"
                      >
                        Add comment
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="profile-reviews tab">
              <h1>User reviews</h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Aliquam pariatur officia, aperiam quidem quasi, tenetur
                molestiae. Architecto mollitia laborum possimus iste esse.
                Perferendis tempora consectetur, quae qui nihil voluptas.
                Maiores debitis repellendus excepturi quisquam temporibus
                quam nobis voluptatem, reiciendis distinctio deserunt vitae!
                Maxime provident, distinctio animi commodi nemo, eveniet
                fugit porro quos nesciunt quidem a, corporis nisi dolorum
                minus sit eaque error sequi ullam. Quidem ut fugiat,
                praesentium velit aliquam!
              </p>
            </div>
            <div class="profile-settings tab">
              <div class="account-setting">
                <h1>Acount Setting</h1>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Reprehenderit omnis eaque, expedita nostrum, facere libero
                  provident laudantium. Quis, hic doloribus! Laboriosam nemo
                  tempora praesentium. Culpa quo velit omnis, debitis
                  maxime, sequi animi dolores commodi odio placeat, magnam,
                  cupiditate facilis impedit veniam? Soluta aliquam
                  excepturi illum natus adipisci ipsum quo, voluptatem,
                  nemo, commodi, molestiae doloribus magni et. Cum, saepe
                  enim quam voluptatum vel debitis nihil, recusandae, omnis
                  officiis tenetur, ullam rerum.
                </p>
              </div>
            </div>
            <div class="profile-settings tab">
              <div class="account-setting">
                <h1>Acount Images</h1>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Reprehenderit omnis eaque, expedita nostrum, facere libero
                  provident laudantium. Quis, hic doloribus! Laboriosam nemo
                  tempora praesentium. Culpa quo velit omnis, debitis
                  maxime, sequi animi dolores commodi odio placeat, magnam,
                  cupiditate facilis impedit veniam? Soluta aliquam
                  excepturi illum natus adipisci ipsum quo, voluptatem,
                  nemo, commodi, molestiae doloribus magni et. Cum, saepe
                  enim quam voluptatum vel debitis nihil, recusandae, omnis
                  officiis tenetur, ullam rerum.
                </p>
              </div>
            </div>
            <div class="profile-settings tab">
              <div class="account-setting">
                <h1>Appeals</h1>
                <div class="profile-create-posts-wrapper">
                  <div class="profile-create-posts-icon-wrapper">
                    <i class="fa-solid fa-plus"></i>
                  </div>
                  <p>Creat a Post</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @push('js')
  <script src="{{ asset('js/profilePage.js?version=1') }}" defer></script>
  <script src="{{ asset('js/cropProfilePage.js') }}" defer></script>
  <script src="{{ asset('js/addPostComment.js?version=1') }}" defer type="module"></script>
  <script src="{{ asset('js/addPostLike.js?version=1') }}" defer type="module"></script>
  <script src="{{ asset('js/toggleModalInputs.js') }}" defer></script>
  @endpush
@endsection
