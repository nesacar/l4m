<div class="blog-list-item">
  <div class="blog-list-item_start-image">
    <div class="image image--standard demo-img"
      data-src="{{ isset($item->img) ? url($item->img) : 'TODO set placeholder or remove data-src?' }}"
    ></div>
  </div>
  <div>
    <div class="blog-list-item_label">{{ isset($item->label) ? $item->label : 'Label' }}</div>
    <div class="blog-list-item_title with-trunk">{{ isset($item->title) ? $item->title : 'Title' }}</div>
  </div>
</div>