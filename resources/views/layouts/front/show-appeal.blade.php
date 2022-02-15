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
      <p class="main-appeal-title">{{ $appeal->title }}</p>
      <p class="main-appeal-title">ID {{ $appeal->uniqueid }}</p>
      <p class="main-appeal-description">
       {{ $appeal->description }}
      </p>
    </div>
  </div>

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

  @if($appeal->video_path)
  <div class="main-appeal-video-container">
    <video
      class="main-appeal-video"
      controls
      src="{{ asset($appeal->video_path) }}"
    ></video>
  </div>
  @endif

  @if($appeal->pdf_path)
  <div class="main-appeal-video-container">
    <a href="{{ $appeal->pdf_path }}" download="true">pdf</a>
  </div>
  @endif
</div>



@push('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

