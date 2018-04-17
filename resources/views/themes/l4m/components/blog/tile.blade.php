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

  $imageUrl = isset($item->img) ? url($item->img) : 'TODO set placeholder image or remove data-src?';
  $title = isset($item->title) ? $item->title : 'Tile title';
  $categorie = isset($item->categorie) ? $item->categorie : 'Categorie';

@endphp

<div class="{{ $className }}">
  <div class="blog-tile_image">
    <div class="image image--standard demo-img"
      data-src="{{ $imageUrl }}"
    ></div>
  </div>
  <div class="blog-tile_content">
    <div class="blog-tile_label">
      <a
        class="blog-tile_categorie with-flare"
        href="{{ url('categories/'.$categorie) }}"
      >{{ $categorie }}</a>
    </div>
    <h4>{{ $title }}</h4>
    <p class="with-trunk">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi placeat adipisci consequatur laboriosam eos ducimus sint eligendi nemo impedit maiores iure ut, quasi repellat eius, atque iusto. Exercitationem, voluptatem rem.</p>
  </div>
</div>