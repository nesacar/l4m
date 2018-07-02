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
                    <a class="category-nav_link {{ session('primary') == 'zene'? 'active' : '' }}"
                       href="{{ url('shop/zene') }}">žene</a>
                    <a class="category-nav_link {{ session('primary') == 'muskarci'? 'active' : '' }}"
                       href="{{ url('shop/muskarci') }}">muškarci</a>
                    <a class="category-nav_link {{ session('primary') == 'deca'? 'active' : '' }}"
                       href="{{ url('shop/deca') }}">deca</a>
                    <a class="category-nav_link {{ session('primary') == 'living'? 'active' : '' }}"
                       href="{{ url('shop/living') }}">living</a>
                </nav>
            </section>
            <a href="{{ url('/') }}" class="logo-wrap">
                <svg class="logo" role="presentation" aria-label="luxury 4 me">
                    <use xlink:href="#logo">
                </svg>
            </a>
            <div class="header_currency expand--sm">
                <form method="GET" id="currency_form">
                    @select([
                        'id' => 'currency',
                        'name' => 'currency',
                      ])
                    <option value="rsd" {{ session('currency')->code == 'RSD'? 'selected' : '' }}>RSD</option>
                    <option value="eur" {{ session('currency')->code == 'EUR'? 'selected' : '' }}>EUR</option>
                    @endselect
                </form>
            </div>
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
        @include('themes.'. $theme .'.components.nav', ['links' => $menu])
    </div>
</header>
