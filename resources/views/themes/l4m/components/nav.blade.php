<nav class="nav">
  @foreach($links as $i => $link)
      @php $className = $link->desc . (Request::is($link->link) ? ' ' . $link->desc . '--active' : ''); @endphp
      <a class="{{ $className }}" href="{{ url($link->link) }}">{{ $link->title}}</a>
      @if($link->title == 'Blog')
      <div class="mega-menu">
        <div class="mega-menu_background"></div>
        <div class="mega-menu_content container">
          <div class="row">
            <div class="col-3 mega-menu_col">
              <a href="#" class="mega-menu_link">žene</a>
            </div>
            <div class="col-3 mega-menu_col">
              <a href="#" class="image image--standard">
                <img src="https://images.pexels.com/photos/699821/pexels-photo-699821.jpeg?auto=compress&cs=tinysrgb&h=350" alt="flowers">
              </a>
            </div>
            <div class="col-3 mega-menu_col">
              <a href="#" class="mega-menu_link">muškarci</a>
            </div>
            <div class="col-3 mega-menu_col">
              <a href="#" class="image image--standard">
                <img src="https://images.pexels.com/photos/700439/pexels-photo-700439.jpeg?auto=compress&cs=tinysrgb&h=350" alt="leafs">
              </a>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  @endforeach
</nav>