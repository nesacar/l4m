<div class="grid">
  @foreach ($items as $i => $item)
    @component('themes.' . env('THEME_NAME', '') . '.components.' . $component, [
      'item' => $item,
      '_index' => $i
    ])
    @endcomponent
  @endforeach
</div>