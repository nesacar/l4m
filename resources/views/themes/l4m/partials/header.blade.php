<header id="header">
  <button class="icon-btn menu-toggler" aria-controls="#navdrawer" aria-expanded="false" data-controls="#navdrawer">
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
      <a href="{{ url('/') }}" class="logo-wrap">
        <svg class="logo" role="presentation" aria-label="luxury 4 me">
          <use xlink:href="#logo">
        </svg>
      </a>
      <div class="header_basket">
        <a href="{{ url('korpa') }}" class="icon-btn">
          @if( \Cart::count() > 0)
          <small class="chip js-basket-chip">{{ \Cart::count() }}</small>
          @endif
          <svg class="icon" role="presentation">
            <use xlink:href="#icon_cart">
          </svg>
        </a>
      </div>
      @search()@endsearch
    </div>
  </div>
  <div id="main-nav">
    <div class="container">
      @include('themes.'. $theme .'.components.nav', ['links' => $menu])
    </div>
  </div>
</header>
