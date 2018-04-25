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

  $imageUrl = isset($item->image) ? url($item->image) : 'TODO set placeholder image or remove data-src?';

@endphp

<div class="{{ $className }}">
  <a class="blog-tile_image" href="{{ $item->getLink()  }}">
    <div class="image image--standard lazy-image" data-src="{{ $imageUrl }}"></div>
  </a>

  <div class="blog-tile_content">
    <div class="blog-tile_label">
      <a class="blog-tile_categorie with-flare" href="{{ url($item->blog->slug) }}">{{ $item->blog->title }}</a>
    </div>
    <h4 class="blog-tile_title"><a href="{{ url($item->blog->slug . '/' . $item->slug . '/' . $item->id) }}">{{ $item->title }}</a></h4>
    <p class="with-trunk">{{ $item->short }}</p>
  </div>
</div>