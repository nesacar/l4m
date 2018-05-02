@php

  $isHorizontal = false;
  $isAsymmetric = false;
  $withLabel = true;
  $imgRatio = 'standard';

  if (isset($_index)) {
    $isOdd = ($_index % 2) == 1;
  }

  if (isset($options)) {
    $isHorizontal = isset($options->horizontal) ? $options->horizontal : false;
    $isAsymmetric = isset($options->asymmetric) ? $options->asymmetric : false;
    $withLabel = isset($options->label) ? $options->label : true;
    $imgRatio = isset($options->imgRatio) ? $options->imgRatio : 'standard';
  }

  $horizontalClass = ($isHorizontal ? ' blog-tile--horizontal' : '');
  $asymmetricClass = (($isAsymmetric && $isOdd) ? ' blog-tile--reverse' : '');
  $className = 'blog-tile' . $horizontalClass . $asymmetricClass;

  $imageUrl = isset($item->image) ? url($item->image) : 'TODO set placeholder image or remove data-src?';

@endphp

<div class="{{ $className }}">
  <a class="blog-tile_image" href="{{ $item->getLink()  }}">
    <div class="image image--{{ $imgRatio }} lazy-image" data-src="{{ $imageUrl }}"></div>
  </a>

  <div class="blog-tile_content">
    @if($withLabel)
    <div class="blog-tile_label">
      <a class="blog-tile_categorie with-flare" href="{{ url($item->blog->slug) }}">{{ $item->blog->title }}</a>
    </div>
    @endif
    <h4 class="display-4 blog-tile_title"><a href="{{ url($item->blog->slug . '/' . $item->slug . '/' . $item->id) }}">{{ $item->title }}</a></h4>
    <p class="with-trunk">{{ $item->short }}</p>
  </div>
</div>