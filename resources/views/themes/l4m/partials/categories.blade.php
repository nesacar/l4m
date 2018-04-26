@php

  $isSmall = isset($options->small) ? $options->small : false;
  $isBig = isset($options->big) ? $options->big : false;
  $className = 'categorie' . ($isSmall ? ' categorie--small' : '') . ($isBig ? ' categorie--big' : '');

@endphp

<div class="{{ $className }}">
  @foreach($categories as $category)
    <a class="categorie_item with-flare" href="{{ url($category->slug) }}">
      <div class="image categorie_image lazy-image"
        data-src="{{ url($category->box_image) }}"
      ></div>
      <div class="categorie_name">{{ $category->title }}</div>
    </a>
  @endforeach
</div>