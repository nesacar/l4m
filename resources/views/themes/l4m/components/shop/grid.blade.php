@php
  $shop = false;
  $hasOptions = isset($options);
  
  if ($hasOptions) {
    $shop = isset($options->shop) ? $options->shop : $shop;
  }

  $className = 'shop-grid' . ($shop ? ' shop-grid--shop' : '');

@endphp

<section class="{{ $className }}">
  {{-- {{dd($items)}} --}}
  @foreach($items as $index => $item)

    @component('themes.' . $theme . '.components.' . $component, [
      'product' => $item,
      'options' => isset($options) ? $options : null,
      '_index' => $index
    ])
    @endcomponent
  @endforeach
</section>