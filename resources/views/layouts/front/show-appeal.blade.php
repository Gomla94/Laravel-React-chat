@extends('layouts.front.app')
@section('content')
<div class="container-fluid main-appeal-wrapper">
  <div class="main-appeal">
    <div class="main-appeal-image-container">
      <img class="main-appeal-image" src="{{ asset($appeal->image ?? 'placeholder.png') }}" alt="" />
    </div>
    <div class="main-appeal-info-container">
      <p class="main-appeal-title">{{ $appeal->title }}</p>
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
            <img src="{{ asset($image->image) }}" alt="" class="appeal-card-image" />
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  @if($appeal->video)
  <div class="main-appeal-video-container">
    <video
      class="main-appeal-video"
      controls
      src="{{ asset($appeal->video) }}"
    ></video>
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

