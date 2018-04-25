<div class="grid">
  @foreach ($items as $item)
    @component('themes.' . $theme . '.components.' . $component, [
      'item' => $item,
      'options' => isset($options) ? $options : null,
      '_index' => $item->id
    ])
    @endcomponent
  @endforeach
</div>