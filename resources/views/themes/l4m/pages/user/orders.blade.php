@extends('themes.' . $theme . '.index')

@section('content')
  <div class="container">
    <div class="checkout">
      <div class="checkout-steps">
        {{-- stepper --}}
        @include('themes.' . $theme . '.pages.user.nav')
      </div>
      <div class="checkout-content mb-4 py-1">
        <h3 class="display-3 text--uppercase text--sans-serif">Moje porudzbine</h3>
        <div><!-- all orders container -->
          @for($i = 0; $i < 2; $i++)
          <div class="order mb-2"><!-- single order -->
            <header class="order-header">
              <div class="text--s">
                <span>Datum kupovine:</span>
                <span>01.11.2018</span>
              </div>
              <span class="badge badge--completed">status</span>
            </header>
            <div class="shop-grid shop-grid--shop order-body"><!-- products in single order -->
              @php
              // generate random number of items in order
              $n = rand(1, 4);
              @endphp
              @for($j = 0; $j < $n; $j++)
              <a href="#" class="shop-item no-link">
                <div class="shop-item_container">
                  <div class="shop-item_presentation">
                    <div class="shop-item_image">
                      <div class="image image--portrait lazy-image"
                        data-src="http://www.s-l.co.rs/images/products/g-shock-camouflage-collection-2208.jpg"
                      ></div>
                    </div>
                    <div class="shop-item_content">
                      <div class="shop-item_name">name</div>
                      <div class="shop-item_brand">brand</div>
                      <div class="shop-item_price">
                        <div class="shop-item_price-tag">321.25 rsd</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              @endfor
            </div><!-- /products in single order -->
            <footer class="order-footer text--bold">
              <div>
                <span>Ukupna cena: </span><span>321654,00</span> rsd
              </div>
            </footer>
          </div><!-- /single order -->
          @endfor

        </div><!-- /all orders container -->
      </div>
    </div>
  </div>
@endsection