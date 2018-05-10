@php

  $hasOptions = isset($options);
  $hasControls = true;
  $isFullWidth = false;

  if ($hasOptions) {
    $hasControls = isset($options->controls) ? $options->controls : $hasControls;
    $isFullWidth = isset($options->fullWidth) ? $options->fullWidth : $isFullWidth;
  }

  $controlsClassName = 'masthead-carousel-controls' . ($hasControls ? '' : ' no-controls');

@endphp

<section class="masthead" id="masthead">

  <div class="{{ $controlsClassName }}">
    <div class="container masthead-carousel-controls_container">
      <button class="masthead-carousel-control masthead-carousel-control--prev" aria-label="previous slide">
        <span class="arrow arrow--left" role="presentation"></span>
      </button>
      <button class="masthead-carousel-control masthead-carousel-control--next" aria-label="next slide">
        <span class="arrow arrow--right" role="presentation"></span>
      </button>
    </div>
  </div>

  @if($isFullWidth)

  <div class="masthead-carousel is-loading">
    @foreach($data as $item)
    <div class="masthead-carousel_item masthead-carousel_item--full-width">
      <div class="image masthead_image masthead_image--full-width invertable-image">  
        <picture>
          <source media="(min-width: 696px)" srcset="{{ $item->slider? url($item->slider) : url($item->image) }}"><!-- src velike slike ide ovde. -->
          <img src="{{ $item->slider? url($item->slider) : url($item->small_image) }}" /><!-- mala slika -->
        </picture>
      </div>
      <div class="masthead-carousel_content--full-width">
        <div class="container">
          <div class="masthead_action-box masthead_action-box--left">
            <h1 class="masthead_title">{{ $item->title }}</h1>
            <p class="masthead_desc">{{ $item->subtitle }}</p>
            <a class="btn btn--primary masthead_action" href="{{ url($item->link) }}">{{ $item->button }}</a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  @else

  <div class="container masthead-carousel is-loading">
    @foreach($data as $item)
    <div class="masthead-carousel_item">
      <div class="image image--ultra-wide masthead_image">
        <img src="{{ $item->slider? url($item->slider) : url($item->image) }}" />
      </div>
      <div class="masthead-carousel_content">
        <div class="masthead_label">
          @if($item->category)
            <a href="{{ $item->category->getLink() }}">{{ $item->category->title }} </a>
          @else
            <a href="{{ $item->blog->getLink() }}">{{ $item->blog->title }}</a>
          @endif
        </div>
        <h3 class="masthead_title"><a href="{{ url($item->getLink()) }}">{{ $item->title }}</a></h3>
        <p class="masthead_desc">{{ $item->subtitle }}</p>
      </div>
    </div>
    @endforeach
  </div>

  @endif
</section>