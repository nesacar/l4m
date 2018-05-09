<nav class="nav">
  @foreach($links as $i => $link)
    @php $className = $link->sufix . (Request::is($link->link) ? ' ' . $link->sufix . '--active' : ''); @endphp
    <div class="nav_item">
      <a class="{{ $className }}" href="{{ url($link->link) }}">{{ $link->title}}</a>
      @if($link->title == 'Blog')
      <div class="mega-menu container">
        <div class="row">
          <div class="col-3">
            <a href="#">women</a>
          </div>
          <div class="col-3">
            <div class="image image--standard">
              <img src="https://images.pexels.com/photos/699821/pexels-photo-699821.jpeg?auto=compress&cs=tinysrgb&h=350" alt="flowers">
            </div>
          </div>
          <div class="col-3">
            <a href="#">men</a>
          </div>
          <div class="col-3">
            <div class="image image--standard">
              <img src="https://images.pexels.com/photos/700439/pexels-photo-700439.jpeg?auto=compress&cs=tinysrgb&h=350" alt="leafs">
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  @endforeach
</nav>