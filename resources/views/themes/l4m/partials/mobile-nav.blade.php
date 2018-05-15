@drawer(['id' => 'navdrawer'])
<nav class="side-nav">
    <ul class="side-nav_menu accordion">
        @foreach($menu as $link)
            @if(count($link->children) == 0)
                <li class="side-nav_menu-item">
                    <a href="{{ url($link->link . $link->sufix) }}" class="side-nav_menu-link">{{ $link->title }}</a>
                </li>
            @else
                <li class="side-nav_menu-item accordion_pane">
                    <button class="icon-btn side-nav_toggle  js-accordion_toggle"
                            aria-controls="#_submenu-id-{{ $link->id }}"
                    >
                      <svg class="icon">
                        <use xlink:href="#icon_arrow">
                      </svg>
                    </button>
                    <a href="#" class="side-nav_menu-link">{{ $link->title }}</a>
                    <div class="accordion_wrapper" id="_submenu-id-{{ $link->id }}">
                        <ul class="side-nav_submenu accordion_content">
                            @foreach($link->children as $subLink)
                            <li>
                                <a href="{{ url($subLink->link . $subLink->sufix) }}" class="side-nav_menu-link">{{ $subLink->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
@enddrawer
