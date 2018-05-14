@drawer(['id' => 'navdrawer'])
  <nav class="side-nav">
    <ul class="side-nav_menu">
      @foreach($menu as $i => $link)
      <li class="side-nav_menu-item">
        <a href="#" class="side-nav_menu-link">menu item 1</a>
      </li>
      <li class="side-nav_menu-item">
        <button class="icon-btn side-nav_toggle"
        aria-controls="#_submenu-id-1"
        >&plus;</button>
        <a href="#" class="side-nav_menu-link">menu item 2</a>
        <div class="side-nav_wrapper" id="_submenu-id-1">
          <ul class="side-nav_submenu">
            <li>
              <a href="#" class="side-nav_menu-link">submenu item 1</a>
            </li>
            <li>
              <a href="#" class="side-nav_menu-link">submenu item 2</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="side-nav_menu-item">
        <a href="#" class="side-nav_menu-link">menu item 3</a>
      </li>
      @endforeach
    </ul>
  </nav>
@enddrawer
