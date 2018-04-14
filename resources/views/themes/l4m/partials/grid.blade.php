<div class="grid">
  @foreach ($items as $i => $item)
    @component('themes.' . env('THEME_NAME', '') . '.components.grid-tile', [
      'img' => $item->img,
      'title' => $item->title,
      '_index' => $i
    ])
    @endcomponent
  @endforeach
</div>