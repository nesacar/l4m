<nav class="nav">
  @foreach($links as $i => $link)
      @php $className = $link->sufix . (Request::is($link->link) ? ' ' . $link->sufix . '--active' : ''); @endphp
      <a class="{{ $className }}" href="{{ url($link->link) }}">{{ $link->title}}</a>
  @endforeach
</nav>