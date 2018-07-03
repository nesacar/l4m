@drawer(['id' => 'navdrawer'])
  <nav class="side-nav header-spacer">
    <ul class="side-nav_menu">
      <li class="side-nav_menu-item">
        <a class="side-nav_menu-link text--uppercase {{session('primary') == 'zene' ? 'text--bold' : ''}}"
          href="{{url('/shop/zene')}}">Žene</a>
      </li>
      <li class="side-nav_menu-item">
        <a class="side-nav_menu-link text--uppercase {{session('primary') == 'muskarci' ? 'text--bold' : ''}}"
          href="{{url('/shop/muskarci')}}">Muškarci</a>
      </li>
      <li class="side-nav_menu-item">
        <a class="side-nav_menu-link text--uppercase {{session('primary') == 'deca' ? 'text--bold' : ''}}"
          href="{{url('/shop/deca')}}">Deca</a>
      </li>
      <li class="side-nav_menu-item">
        <a class="side-nav_menu-link text--uppercase {{session('primary') == 'living' ? 'text--bold' : ''}}"
          href="{{url('/shop/living')}}">Living</a>
      </li>
    </ul>
    <ul class="side-nav_menu accordion">
      @foreach($menu as $link)
        @if(count($link->children) == 0)
        <li class="side-nav_menu-item">
          <a href="{{ url($link->link . $link->sufix) }}"
            class="side-nav_menu-link"
          >{{ $link->title }}</a>
        </li>
        @else
        <li class="side-nav_menu-item accordion_pane">
          <button class="icon-btn side-nav_toggle  js-accordion_toggle"
            aria-controls="#_submenu-id-{{ $link->id }}">
            <svg class="icon">
              <use xlink:href="#icon_arrow">
            </svg>
          </button>
          <a href="{{ url($link->link . $link->sufix) }}"
            class="side-nav_menu-link"
          >{{ $link->title }}</a>
          <div class="accordion_wrapper" id="_submenu-id-{{ $link->id }}">
            <ul class="side-nav_submenu accordion_content">
              @foreach($link->children as $subLink)
              <li>
                <a href="{{ url($subLink->link . $subLink->sufix) }}"
                  class="side-nav_menu-link"
                >{{ $subLink->title }}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </li>
        @endif
      @endforeach
    </ul>
    <ul class="side-nav_menu">
      <li class="side-nav_menu-item" style="position: relative;">
        <a class="side-nav_menu-link"
          href="/korpa"
        >Korpa<span class="chip chip--side-nav js-basket-chip"></span></a>
      </li>
      <li class="side-nav_menu-item">
        <a href="/#" class="side-nav_menu-link">Wishlist</a>
      </li>
      <li class="side-nav_menu-item">
        <a href="/logovanje" class="side-nav_menu-link">Logovanje</a>
      </li>
      <li class="side-nav_menu-item">
        <a href="/registracija" class="side-nav_menu-link">Registracija</a>
      </li>
    </ul>
  </nav>
@enddrawer
