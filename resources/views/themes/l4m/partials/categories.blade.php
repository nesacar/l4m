<div class="categorie">
  @foreach($categories as $i => $categorie)
    <a class="categorie_item with-flare" href="{{ $categorie->href }}">
      <div class="image categorie_image lazy-image"
        data-src="{{ $categorie->img }}"
      ></div>
      <div class="categorie_name">{{ $categorie->text }}</div>
    </a>
  @endforeach
</div>