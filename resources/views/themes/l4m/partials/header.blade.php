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
      <section class="header_section--left expand--md">
        {{-- @social() --}}
        <nav class="category-nav">
          <a class="category-nav_link active" href="#">muškarci</a>
          <a class="category-nav_link" href="#">žene</a>
          <a class="category-nav_link" href="#">deca</a>
          <a class="category-nav_link" href="#">lifestyle</a>
        </nav>
      </section>
      <a href="{{ url('/') }}" class="logo-wrap">
        <svg class="logo" role="presentation" aria-label="luxury 4 me">
          <use xlink:href="#logo">
        </svg>
      </a>
      <div class="header_basket">
        <a href="{{ url('korpa') }}" class="icon-btn">
          <small class="chip js-basket-chip">{{ !! \Cart::count() ? \Cart::count() : '' }}</small>
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
