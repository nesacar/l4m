<ul class="social">
  @foreach($items as $i => $item)
  @php

    $label = isset($item->label) ? $item->label : ('follow us on '.$item->platform);

  @endphp
  <li class="social_item">
    <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}">
      <svg class="icon" role="presentation">
        <use xlink:href="#icon_{{ $item->platform }}">
      </svg>
    </a>
  </li>
  @endforeach
</ul>