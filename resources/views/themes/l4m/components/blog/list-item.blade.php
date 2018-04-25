<a class="blog-list-item" href="{{ $item->getLink() }}">
  <div class="blog-list-item_start-image">
    <div class="image image--standard lazy-image"
      data-src="{{ isset($item->image) ? url($item->image) : 'TODO set placeholder or remove data-src?' }}"
    ></div>
  </div>
  <div>
    <div class="blog-list-item_label">{{ $item->blog->title }}</div>
    <div class="blog-list-item_title with-trunk">{{ $item->title }}</div>
  </div>
</a>