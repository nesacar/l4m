<header id="header">
  <div class="header">
    <div class="container header_content">
      <a class="logo-container" href="/">
        <svg class="logo" role="presentation">
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