@extends('themes.' . $theme . '.index')

@section('content')
    <div class="container">
        <div class="checkout">
            <div class="checkout-steps">
                {{-- stepper --}}
                @include('themes.' . $theme . '.pages.user.nav', ['active' => 'orders'])
            </div>
            @if(!empty($carts))
            <div class="checkout-content mb-4 py-1">
                <h3 class="display-3 text--uppercase text--sans-serif">Moje porudžbine</h3>
                <div><!-- all orders container -->
                    @foreach($carts as $cart)
                        <div class="order mb-2"><!-- single order -->
                            <header class="order-header">
                                <div class="text--s">
                                    <span>Datum kupovine:</span>
                                    <span>{{ \Carbon\Carbon::parse($cart->created_at)->format('d.m.Y.') }}</span>
                                </div>
                                <span class="badge badge--{{ $cart->paid? 'completed' : 'pending' }}">{{ $cart->paid? 'Plaćeno' : 'Na čekanju' }}</span>
                            </header>
                            @if(!empty($cart->order))
                            <div class="shop-grid shop-grid--shop order-body"><!-- products in single order -->
                               @foreach($cart->order as $order)
                                    <a href="{{ $order->product->getLink() }}" class="shop-item no-link">
                                        <div class="shop-item_container">
                                            <div class="shop-item_presentation">
                                                <div class="shop-item_image">
                                                    <div class="image image--portrait lazy-image"
                                                         data-src="{{ url(\Imagecache::get($order->product->image, '215x287')->src) }}"
                                                    ></div>
                                                </div>
                                                <div class="shop-item_content">
                                                    <div class="shop-item_name">{{ $order->product->title }}</div>
                                                    <div class="shop-item_brand">{{ $order->product->brand->title }}</div>
                                                    <div class="shop-item_price">
                                                        <div class="shop-item_price-tag">{{ $order->total }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div><!-- /products in single order -->
                            @endif
                            <footer class="order-footer text--bold">
                                <div>
                                    <span>Ukupna cena: </span><span>{{ $cart->total}}</span> rsd
                                </div>
                            </footer>
                        </div><!-- /single order -->
                    @endforeach

                </div><!-- /all orders container -->
            </div>
            @endif
        </div>
    </div>
@endsection