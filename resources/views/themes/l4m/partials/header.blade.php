<header id="header">
  <button class="menu-toggler" id="js-menu-toggler">
    <div class="menu-icon">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </button>
  <div class="header">
    <div class="container header_content">
      <a href="{{ url('/') }}">
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

<script>
  document.querySelector('#js-menu-toggler')
    .addEventListener('click', function () {
      this.classList.toggle('active');
    });
</script>