<header class="container" id="header">
  <div class="header">
    <div class="header_content">
      <a class="logo-container" href="/">
        <svg class="logo" role="presentation">
          <use xlink:href="#logo">
        </svg>
      </a>
    </div>
    @include('themes.'.env('THEME_NAME', '').'.partials.nav')
  </div>
</header>