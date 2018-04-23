@php

  $data = [
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/315987/pexels-photo-315987.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/273758/pexels-photo-273758.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
    (object)[
      'label' => 'travel',
      'img' => 'https://images.pexels.com/photos/273760/pexels-photo-273760.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260',
      'title' => 'Bentley - Inspired by the Finest Luxury Yachts',
      'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil corrupti consectetur facere impedit.'
    ],
  ]

@endphp

<section class="masthead">
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