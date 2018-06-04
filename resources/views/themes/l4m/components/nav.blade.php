<nav class="nav">
  @foreach($links as $i => $link)
    @php
      $linkClassName = $link->desc . (\App\Helper::activeLink($link->link)? ' ' . $link->desc . '--active' : '');
      $itemClassName = (count($link->children) > 0)
        ? 'nav_item js-nav-item'
        : 'nav_item';
    @endphp
    <div class="{{ $itemClassName }}">
      @if(count($link->children)>0)
        <span class="{{ $linkClassName }}">{{ $link->title}}</span>
        <div class="mega-menu">
          <div class="mega-menu_scrim"></div>
          <div class="mega-menu_content">
            <div class="container mega-menu_row">
              <div class="menu-list mega-menu_col">
                @foreach($link->children as $subLink)
                    <a class="menu-list_item"
                      href="{{url($subLink->link . $subLink->sufix)}}"
                    >{{$subLink->title}}</a>
                @endforeach
              </div>
              <!-- demo -->
              @if(!empty($link->image))
                <div class="demo-img-box">
                  <div class="image image--ultra-wide">

                    <img src="{{ url($link->image) }}" alt="{{ $link->link }}">

                  </div>
                  <span class="demo-something">{{ $link->title }}</span>
                </div>
                <!-- /demo -->
              @endif
            </div>
          </div>
        </div>
      @else
        <a class="{{ $linkClassName }}" href="{{ url($link->link . $link->sufix) }}">{{ $link->title}}</a>
      @endif
    </div>
  @endforeach
</nav>