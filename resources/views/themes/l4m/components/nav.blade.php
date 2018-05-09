<nav class="nav">
  @foreach($links as $i => $link)
      @php $className = $link->desc . (Request::is($link->link) ? ' ' . $link->desc . '--active' : ''); @endphp
      <a class="{{ $className }}" href="{{ url($link->link) }}">{{ $link->title}}</a>
  @endforeach
</nav>