@php

  $id = $options->id;

@endphp

<div style="text-align: center;">
  @foreach($products as $index => $items)
    <input class="tab_control" type="radio" name="{{ $id }}" id="{{ $id . '-tab-' . $index }}" @if($loop->first) checked @endif>
    <label class="tab_label" for="{{ $id . '-tab-' . $index }}">{{ $items->title }}</label>
  @endforeach

  @foreach($products as $index => $items)
  <div class="tab_content" id={{ $id . '-content-' . $index }}>
    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $items->products4,
      'options' => isset($options) ? $options : null,
    ])
    @endcomponent
  </div>
  @endforeach
</div>