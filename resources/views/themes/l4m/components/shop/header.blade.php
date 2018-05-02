@php

  $name = isset($name) ? $name : 'Brand name';
  // tmp
  $img = isset($img) ? $img : 'https://images.pexels.com/photos/968245/pexels-photo-968245.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260';

@endphp

<div class="shop-header">
  <div class="image shop-header_image lazy-image"
    data-src="{{ url($img) }}"
  >
  </div>
  <h2 class="display-2 shop-header_title">{{ $name }}</h2>
</div>