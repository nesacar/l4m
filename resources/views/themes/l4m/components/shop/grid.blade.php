@php
  $shop = false;
  $hasOptions = isset($options);
  
  if ($hasOptions) {
    $shop = isset($options->shop) ? $options->shop : $shop;
  }

  $className = 'shop-grid' . ($shop ? ' shop-grid--shop' : '');

@endphp

<section class="{{ $className }}">
  @foreach($items as $index => $item)

    @component('themes.' . $theme . '.components.' . $component, [
      'product' => $item,
      'category' => isset($category) ? $category : $item->category->first(),
      'options' => isset($options) ? $options : null,
      '_index' => $index
    ])
    @endcomponent
  @endforeach
</section>