<ul class="list">
  @foreach ($items as $i => $item)
  <li class="list_item">
    @component('themes.' . env('THEME_NAME', '') . '.components.' . $component, [
      'item' => $item,
      '_index' => $i
    ])
    @endcomponent
  </li>
  @endforeach
</ul>