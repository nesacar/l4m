@php

  $name = isset($name) ? $name : 'Brand name';

@endphp

<div class="shop-header">
  <div class="image shop-header_image lazy-image"
    data-src="{{ $img }}"
  >
  </div>
  <h2 class="display-2 shop-header_title">{{ $name }}</h2>
</div>