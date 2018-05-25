@extends('themes.' . $theme . '.index')

@section('content')

    <div class="cart">
        @if(!empty(\Cart::content()))
            <section class="container cart_header">
                <h1 class="cart_heading cart_heading--1">Korpa</h1>
                <div class="cart_header-line">
                  <div class="cart_secondary-text">Imate {{ \Cart::count() }} {{ \Cart::count()%10 == 1 ? 'proizvod' : 'proizvoda'  }} u korpi.</div>
                  <button class="icon-btn" title="Isprazni korpu">
                    <svg class="icon" role="presentation">
                      <use xlink:href="#icon_delete">
                    </use></svg>
                  </button>
                </div>
            </section>
            <section class="container">
                <div class="cart_list">
                    <div class="row expand--md cart_secondary-text">
                        <div class="col-md-6">Proizvod</div>
                        <div class="col-md-3">Količina</div>
                        <div class="col-md-3">Ukupno</div>
                    </div>
                    <hr>
                    @foreach(\Cart::content() as $product)
                        @cartentry(['product' => $product]) @endcartentry
                        <hr>
                    @endforeach
                </div>
            </section>
            <section class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <h2 class="cart_heading cart_heading--2">Ukupno u korpi</h2>
                        <div class="receipt">
                            <div class="receipt_fraction">
                                <span class="receipt_key">cena</span>
                                <span class="receipt_value shop-item_price-tag">{{ \Cart::subtotal() }}</span>
                            </div>
                            <div class="receipt_fraction">
                                <span class="receipt_key">dostava</span>
                                <span class="receipt_value">besplatna</span>
                            </div>
                            <div class="receipt_fraction">
                                <span class="receipt_key">ukupno</span>
                                <span class="receipt_value shop-item_price-tag">{{ \Cart::total() }}</span>
                            </div>
                        </div>
                        <div class="cart_coupon">
                          <input class="text-input" type="text" name="kupon" id="kupon" placeholder="Unesite promo kod">
                          <button class="btn btn--primary">iskoristi promo kod</button>
                        </div>
                        @if(\Cart::count()>0)
                            <div class="cart_actions">
                                <a href="/shop" class="btn btn--outline btn--block">nastavi kupovinu</a>
                                <button class="btn btn--primary btn--block">Idite na plaćanje</button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        {{--<h2 class="cart_heading cart_heading--2">You may also like</h2>--}}
                        {{--<ul>--}}
                        {{--<li>item</li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
            </section>
        @endif
    </div>

@endsection
