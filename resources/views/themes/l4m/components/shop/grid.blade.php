@php
  $shop = false;
  $hasOptions = isset($options);
  
  if ($hasOptions) {
    $shop = isset($options->shop) ? $options->shop : $shop;
  }

  $className = 'shop-grid' . ($shop ? ' shop-grid--shop' : '');

@endphp

<section class="{{ $className }}">
  @foreach($items as $i => $item)
    @component('themes.' . env('THEME_NAME', '') . '.components.' . $component, [
      'product' => $item,
      'options' => isset($options) ? $options : null,
      '_index' => $i
    ])
    @endcomponent
  @endforeach
</section>