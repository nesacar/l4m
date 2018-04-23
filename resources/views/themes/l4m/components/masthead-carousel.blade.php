@php

  $hasOptions = isset($options);
  $hasControls = true;

  if ($hasOptions) {
    $hasControls = isset($options->controls) ? $options->controls : $hasControls;
  }

  $controlsClassName = 'masthead-carousel-controls' . ($hasControls ? '' : ' no-controls');

@endphp

<section class="masthead" id="masthead">

  <div class="{{ $controlsClassName }}">
    <div class="container masthead-carousel-controls_container">
      <button class="masthead-carousel-control masthead-carousel-control--prev">
        <span class="arrow arrow--left" role="presentation"></span>
      </button>
      <button class="masthead-carousel-control masthead-carousel-control--next">
        <span class="arrow arrow--right" role="presentation"></span>
      </button>
    </div>
  </div>

  <div class="container masthead-carousel is-loading">
    @foreach($data as $i => $item)
    <div class="masthead-carousel_item">
      <div class="image image--ultra-wide masthead_image">
        <img src="{{ $item->img}}" />
      </div>
      <div class="masthead-carousel_content">
        <div class="masthead_label">{{ $item->label }}</div>
        <h3 class="masthead_title">{{ $item->title }}</h3>
        <p class="masthead_desc">{{ $item->desc }}</p>
      </div>
    </div>
    @endforeach
  </div>
</section>