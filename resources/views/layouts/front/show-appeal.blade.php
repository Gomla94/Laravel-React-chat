@extends('layouts.front.app')
@section('content')
<div class="one-appeal-container">
    <div class="one-appeal-info-container">
        <div class="one-appeal-image-container">
            <img src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" class="one-appeal-image" />
        </div>
        <div class="one-appeal-description-container">
            <p class="one-appeal-title">this is the first appeal</p>
            <p class="one-appeal-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad autem reprehenderit dicta qui ipsum necessitatibus ab laborum, aliquam ipsam, quo commodi exercitationem veritatis adipisci cupiditate explicabo. Quia, aliquam. Dolore, quisquam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil aspernatur dicta, asperiores culpa quas, impedit ex inventore quod nulla eum maiores eos porro molestias voluptates iusto. Pariatur commodi magnam earum?
            </p>
        </div>
    </div>
    <div class="swiper mySwiper one-appeal-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="one-appeal-other-image-container">
              <img class="one-appeal-other-image" src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" alt="">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="one-appeal-other-image-container">
              <img class="one-appeal-other-image" src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" alt="">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="one-appeal-other-image-container">
              <img class="one-appeal-other-image" src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" alt="">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="one-appeal-other-image-container">
              <img class="one-appeal-other-image" src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" alt="">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="one-appeal-other-image-container">
              <img class="one-appeal-other-image" src="{{ asset('images/posts/61a75f31cd38d.jpg') }}" alt="">
            </div>
          </div>
        </div>
    </div>
    <div class="one-appeal-video-container">
        <video src="{{ asset('videos/posts/619b88c162e9b.mp4') }}" controls class="one-appeal-video"></video>
    </div>
</div>

@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
          spaceBetween: 30,
          autoplay: true,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
    });
  </script>
@endpush
@endsection

