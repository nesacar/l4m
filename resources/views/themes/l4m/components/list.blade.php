<ul class="list">
  @foreach ($items as $i => $item)
  <li class="list_item">
    @component('themes.' . 'l4m' . '.components.' . $component, [
      'item' => $item,
      'options' => isset($options) ? $options : null,
      '_index' => $i
    ])
    @endcomponent
  </li>
  @endforeach
</ul>