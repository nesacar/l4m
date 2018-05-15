@drawer(['id' => 'navdrawer'])
<nav class="side-nav">
    <ul class="side-nav_menu">
        @foreach($menu as $link)
            @if(count($link->children) == 0)
                <li class="side-nav_menu-item">
                    <a href="{{ url($link->link . $link->sufix) }}" class="side-nav_menu-link">{{ $link->title }}</a>
                </li>
            @else
                <li class="side-nav_menu-item">
                    <button class="icon-btn side-nav_toggle"
                            aria-controls="#_submenu-id-{{ $link->id }}"
                    >&plus;
                    </button>
                    <a href="#" class="side-nav_menu-link">{{ $link->title }}</a>
                    <div class="side-nav_wrapper" id="_submenu-id-{{ $link->id }}">
                        <ul class="side-nav_submenu">
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
