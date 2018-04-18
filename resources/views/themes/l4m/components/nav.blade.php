<nav class="nav">
  @foreach($links as $i => $link)
  @php

    $className = 'nav_link' . (Request::is($link->href) ? ' nav_link--active' : '');

  @endphp
  <a class="{{ $className }}" href="{{ url($link->href) }}">{{ $link->text}}</a>
  @endforeach
</nav>