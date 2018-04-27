<div style="text-align: center;">
  @foreach($bars as $index => $items)
    <input class="tab_control" type="radio" name="{{ $options->id }}" id="{{ $options->id . '-tab-' . $index }}" @if($loop->first) checked @endif>
    <label class="tab_label" for="{{ $options->id . '-tab-' . $index }}">{{ $items->category->title }}</label>
  @endforeach

  @foreach($bars as $index => $items)
  <div class="tab_content" id={{ $options->id . '-content-' . $index }}>
    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $items->product,
      'options' => isset($options) ? $options : null,
    ])
    @endcomponent
  </div>
  @endforeach
</div>