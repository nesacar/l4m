<header id="header">
  <button class="icon-btn menu-toggler" id="js-menu-toggler">
    <div class="menu-icon">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </button>
  <div class="header">
    <div class="container header_content">
      <div class="header_social">
        @social()
      </div>
      <a href="{{ url('/') }}">
        <svg class="logo" role="presentation" aria-label="luxury 4 me">
          <use xlink:href="#logo">
        </svg>
      </a>
      @search()
      @endsearch
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