@php
  $shop = false;
  $hasOptions = isset($options);
  
  if ($hasOptions) {
    $shop = isset($options->shop) ? $options->shop : $shop;
  }

  $className = 'shop-grid' . ($shop ? ' shop-grid--shop' : '');

@endphp

<section class="{{ $className }}">
  @foreach($items as $item)
    @component('themes.' . $theme . '.components.' . $component, [
      'product' => $item,
      'options' => isset($options) ? $options : null,
      '_index' => $item->id
    ])
    @endcomponent
  @endforeach
</section>