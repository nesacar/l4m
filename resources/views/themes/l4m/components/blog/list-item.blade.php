<a class="blog-list-item" href="{{ $item->href }}">
  <div class="blog-list-item_start-image">
    <div class="image image--standard demo-img"
      data-src="{{ isset($item->img) ? url($item->img) : 'TODO set placeholder or remove data-src?' }}"
    ></div>
  </div>
  <div>
    <div class="blog-list-item_label">{{ isset($item->categorie) ? $item->categorie : 'Label' }}</div>
    <div class="blog-list-item_title with-trunk">{{ isset($item->title) ? $item->title : 'Title' }}</div>
  </div>
</a>