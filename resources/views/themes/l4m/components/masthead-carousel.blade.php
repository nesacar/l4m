@php

  $data = [
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/189296/pexels-photo-189296.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/380285/pexels-photo-380285.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/271795/pexels-photo-271795.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
  ]

@endphp

<section class="masthead" id="masthead">
  <div class="masthead-carousel-controls">
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