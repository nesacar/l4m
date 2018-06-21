@extends('themes.' . $theme . '.index')

@section('content')

    <div class="cart">
        @if(!empty($cart))
            <form action="{{ route('cart.update') }}" method="POST" id="cart-update">
                @csrf
                <section class="container cart_header">
                    <h1 class="cart_heading cart_heading--1">Korpa</h1>
                    <div class="cart_header-line cart_secondary-text">
                        <div>Imate {{ \Cart::count() }} {{ \Cart::count()%10 == 1 ? 'proizvod' : 'proizvoda'  }} u
                            korpi.
                        </div>
                        <button class="icon-btn" title="Isprazni korpu">
                            <svg class="icon" role="presentation">
                                <use xlink:href="#icon_delete">
                                </use>
                            </svg>
                        </button>
                    </div>
                </section>
                <section class="container">
                    <div class="cart_list">
                        <div class="cart_table-row cart_table-row--header cart_secondary-text">
                            <div class="cart_table-cell expand--md"></div>
                            <div class="cart_table-cell">Proizvod</div>
                            <div class="cart_table-cell">Količina</div>
                            <div class="cart_table-cell expand--md">Ukupno</div>
                            <div class="cart_table-cell"></div>
                        </div>
                        @foreach($cart as $product)
                            @cartentry(['product' => $product]) @endcartentry
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
                                <input class="text-input" type="text" name="kupon" id="kupon"
                                       placeholder="Unesite promo kod">
                                <button class="btn btn--primary">iskoristi promo kod</button>
                            </div>
                            <div class="cart_actions">
                                <a href="/shop" class="btn btn--outline btn--block">nastavi kupovinu</a>
                                <a class="btn btn--primary btn--block" id="submit" href="{{ url('placanje/adresa-slanja') }}">Idite
                                    na plaćanje</a>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        (function () {
            document.getElementById('submit').onclick = function(e){
                e.preventDefault();
                document.getElementById('cart-update').submit();
            }
        }());
    </script>
@endsection
