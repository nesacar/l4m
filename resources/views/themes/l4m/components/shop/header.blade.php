@php

  $name = isset($name) ? $name : 'Brand name';

@endphp

<div class="shop-header">
  @if(isset($img))
  <div class="image shop-header_image invertable-image">
    <img src="{{ url($img) }}">
  </div>
  @endif
  {{-- <h2 class="display-2 shop-header_title">{{ $name }}</h2> --}}
</div>