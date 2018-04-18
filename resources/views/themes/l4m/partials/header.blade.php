<header class="container" id="header">
  <div class="header">
    <div class="header_content">
      <a class="header_logo-container with-flare" href="/">
        <svg class="header_logo" role="presentation">
          <use xlink:href="#logo">
        </svg>
      </a>
    </div>
    @include('themes.'.env('THEME_NAME', '').'.partials.nav')
  </div>
</header>