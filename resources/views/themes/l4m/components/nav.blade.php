<nav class="nav">
  @foreach($links as $i => $link)
    @php $className = $link->desc . (\App\Helper::activeLink($link->link)? ' ' . $link->desc . '--active' : ''); @endphp
    <div class="nav_item">
      <a class="{{ $className }}" href="{{ url($link->link . $link->sufix) }}">{{ $link->title}}</a>
      @if(count($link->children)>0)
      <div class="mega-menu">
        <div class="mega-menu_background"></div>
        <div class="mega-menu_content container">
          <div class="row">
            @foreach($link->children as $subLink)
            <div class="col-3 mega-menu_col">
              <a href="{{ url($subLink->link . $subLink->sufix) }}" class="mega-menu_link">{{ $subLink->title }}</a>
            </div>
            <div class="col-3 mega-menu_col">
              <a href="{{ $subLink->link . $subLink->sufix }}" class="image image--standard">
                <img src="{{ url($subLink->image) }}" alt="{{ $subLink->title }}">
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif
    </div>
  @endforeach
</nav>