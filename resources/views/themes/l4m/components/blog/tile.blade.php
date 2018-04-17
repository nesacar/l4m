@php
  $isHorizontal = false;
  $isAsymmetric = false;
  $isOdd = ($_index % 2) == 1;

  if (isset($options)) {
    $isHorizontal = isset($options->horizontal) ? $options->horizontal : false;
    $isAsymmetric = isset($options->asymmetric) ? $options->asymmetric : false;
  }

  $horizontalClass = ($isHorizontal ? ' blog-tile--horizontal' : '');
  $asymmetricClass = (($isAsymmetric && $isOdd) ? ' blog-tile--reverse' : '');
  $className = 'blog-tile' . $horizontalClass . $asymmetricClass;

@endphp

<div class="{{ $className }}">
  <div class="blog-tile_image">
    <div class="image image--standard demo-img"
    data-src="{{ isset($item->img) ? url($item->img) : 'TODO set placeholder image or remove data-src?' }}"
    ></div>
  </div>
  <div class="blog-tile_content">
    <h4>{{ isset($item->title) ? $item->title : 'Tile title' }}</h4>
  </div>
</div>