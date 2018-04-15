<div class="grid_tile demo">
  <div class="image image--standard demo-img"
    data-src="{{ isset($item->img) ? $item->img : 'TODO set placeholder image or remove data-src?' }}"
  ></div>
  <span>{{ isset($item->title) ? $item->title : 'Tile title' }}</span>
</div>