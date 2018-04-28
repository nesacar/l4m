<header id="header">
  <div class="header">
    <div class="container header_content">
      <a class="logo-container" href="{{ url('/') }}">
        <svg class="logo" role="presentation" aria-label="luxury 4 me">
          <use xlink:href="#logo">
        </svg>
      </a>
    </div>
  </div>
  <div id="main-nav">
    <div class="container">
      @include('themes.'. $theme .'.components.nav', ['links' => $menu])
    </div>
  </div>
</header>