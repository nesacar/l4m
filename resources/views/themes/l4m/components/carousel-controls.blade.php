@php
  $visible = isset($controls) ? $controls : true;
  $classname = 'masthead-carousel-controls'.($visible ? '' : ' no-controls');
@endphp
<div class="{{$classname}}">
  <div class="container masthead-carousel-controls_container">
    <button class="masthead-carousel-control masthead-carousel-control--prev"
      aria-label="previous slide">
      <span class="arrow arrow--left" role="presentation"></span>
    </button>
    <button class="masthead-carousel-control masthead-carousel-control--next"
      aria-label="next slide">
      <span class="arrow arrow--right" role="presentation"></span>
    </button>
  </div>
</div>
