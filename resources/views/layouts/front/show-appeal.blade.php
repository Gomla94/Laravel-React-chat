@extends('layouts.front.app')
@section('meta-description')
<meta name="description" content="this is the appeal {{ $appeal->title }} main page">
@endsection
@section('content')
<div class="container-fluid main-appeal-wrapper">
  <div class="main-appeal">
    <div class="main-appeal-image-container">
      <img class="main-appeal-image" src="{{ asset($appeal->image_path ?? 'placeholder.png') }}" alt="" />
    </div>
    
    <div class="main-appeal-info-container">
      <div class="appeal-share-links-wrapper">
          <div class="facebook-share-link">
            <a href="{{ $share_links['facebook'] }}" target="_blank">Facebook</a>
          </div>
          <div class="twitter-share-link">
            <a href="{{ $share_links['twitter'] }}" target="_blank">Twitter</a>
          </div>
          <div class="linkedin-share-link">
            <a href="{{ $share_links['linkedin'] }}" target="_blank">Linkedin</a>
          </div>
      </div>
      <p class="main-appeal-title">{{ $appeal->title }}</p>
      <p class="main-appeal-title">ID {{ $appeal->uniqueid }}</p>
      <p class="main-appeal-description">
       {{ $appeal->description }}
      </p>
    </div>
  </div>

  @if($appeal_images->count() > 0)
    <div class="swiper appeal-swiper">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($appeal_images as $image)
        <div class="swiper-slide">
          <div class="appeal-card">
            <div class="appeal-card-image-wrapper">
              <img src="{{ asset($image->image_path) }}" alt="" class="appeal-card-image" />
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  @endif

  @if($appeal->video_path)
  <div class="main-appeal-video-container">
    <video
      class="main-appeal-video"
      controls
      src="{{ asset($appeal->video_path) }}"
    ></video>
  </div>
  @endif

  <div class="appeal-report-wrapper">
    <div class="appeal-id-wrapper">
      <div class="main-appeal-info">
        <p class="appeal-id-title">Как могу помочь?</p>
        <p class="appeal-id-description">Чтобы помочь Анастасие, можете отправить вашу желаему сумму на счет Magaxat, отметив ID получателя</p>
      </div>
      <div class="main-appeal-id-container">
        <div class="pdf-btnone-wrapper">{{$appeal->uniqueid}}</div>
      </div>
    </div>
    <div class="appeal-pdf-wrapper">
      @if($appeal->pdf_path !== null)
      <div class="appeal-pdf-download-wrapper">
        <a href="{{ $appeal->pdf_path }}" download="true">
        <p class="download-pdf-title">скачать докумнет</p>
      </a>
        <i class="fa-solid fa-download"></i>
      </div>
      @endif
      <div class="pdf-buttons-wrapper">
        <div class="pdf-button-one-wrapper">
          <span class="title-one">Сделать</span>
          <div class="pdf-btnone-wrapper">онлайн перевод</div>
        </div>
        <div class="pdf-button-two-wrapper">
          <span class="title-two">или</span>
          <div class="pdf-btntwo-wrapper">Банковский перевод</div>
        </div>
      </div>
      <div class="currency-wrapper">        
      </div>
    </div>
  </div>
  <div class="trans-data h-trans">
    <div class="trans-data-header">
      <div class="trans-header-icon-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M243.4 2.587C251.4-.8625 260.6-.8625 268.6 2.587L492.6 98.59C506.6 104.6 514.4 119.6 511.3 134.4C508.3 149.3 495.2 159.1 479.1 160V168C479.1 181.3 469.3 192 455.1 192H55.1C42.74 192 31.1 181.3 31.1 168V160C16.81 159.1 3.708 149.3 .6528 134.4C-2.402 119.6 5.429 104.6 19.39 98.59L243.4 2.587zM256 128C273.7 128 288 113.7 288 96C288 78.33 273.7 64 256 64C238.3 64 224 78.33 224 96C224 113.7 238.3 128 256 128zM127.1 416H167.1V224H231.1V416H280V224H344V416H384V224H448V420.3C448.6 420.6 449.2 420.1 449.8 421.4L497.8 453.4C509.5 461.2 514.7 475.8 510.6 489.3C506.5 502.8 494.1 512 480 512H31.1C17.9 512 5.458 502.8 1.372 489.3C-2.715 475.8 2.515 461.2 14.25 453.4L62.25 421.4C62.82 420.1 63.41 420.6 63.1 420.3V224H127.1V416z"/></svg>
      </div>
    </div>
    <div class="trans-data-details">
      <div class="trans-data-keys">
        <span class="trans-key">Получатель</span>
        <span class="trans-key">Счет получателя</span>
        <span class="trans-key">Банк получателя</span>
        <span class="trans-key">БИК</span>
        <span class="trans-key">Название организации</span>
        <span class="trans-key">Директор </span>
      </div>
      <div class="trans-data-vals">
        <span class="trans-val">Дарья Иванова</span>
        <span class="trans-val">26785340876</span>
        <span class="trans-val">Сбербанк</span>
        <span class="trans-val">26785340876</span>
        <span class="trans-val">Magaxat</span>
        <span class="trans-val">Владимир Романов</span>
      </div>
    </div>
  </div>
</div>



@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/toggleAppeal.js') }}" defer></script>
<script>
  var swiper = new Swiper(".swiper", {
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

