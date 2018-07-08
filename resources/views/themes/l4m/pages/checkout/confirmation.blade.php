@extends('themes.'.$theme.'.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    <div class="container">
        <div class="checkout">
            <div class="checkout-steps">
                @stepper([
                  'steps' => [
                    (object)[
                      'link' => '/placanje/adresa-slanja',
                      'text' => 'Adresa slanja',
                      'disabled' => false,
                    ],
                    (object)[
                      'link' => '/placanje/nacin-slanja',
                      'text' => 'Način slanja',
                      'disabled' => false,
                    ],
                    (object)[
                      'link' => '/placanje/nacin-placanja',
                      'text' => 'Način plaćanja',
                      'disabled' => false,
                    ],
                    (object)[
                      'link' => '/placanje/potvrda-porudzbine',
                      'text' => 'Potvrda porudžbine',
                      'disabled' => false,
                    ],
                    (object)[
                      'link' => '/placanje/kraj',
                      'text' => 'Kraj',
                      'disabled' => true,
                    ],
                  ],
                ])
                @endstepper
            </div>
            <div class="checkout-content my-4">
                <section>
                    <h2 class="subtitle subtitle--sans-serif display-4">Potvrdite narudžbinu</h2>
                    <p>Pažljivo pročitajte podatke o Vašoj porudžbini i ukoliko je sve uredu kliknite na dugme
                        "Poruči".</p>
                    <p>Poručujući robu izražavate saglasnost sa <a href="#terms-and-privacy"
                                                                   style="text-decoration: underline;">Uslovima online
                            poslovanja i Politikom privatnosti</a></p>
                </section>

                <section class="checkout-details mb-2">
                    <div class="checkout-detail">
                        <div class="checkout-detail_header">
                            <h4 class="text--bold text--sans-serif display-5 no-margin">Adresa isporuke</h4>
                            <a class="icon-btn ml-auto" href="{{ url('placanje/adresa-slanja') }}" title="izmeni">
                                <svg class="icon">
                                    <use xlink:href="#icon_edit">
                                </svg>
                            </a>
                        </div>
                        <div class="checkout-detail_body">
                            <p class="chekcout-detail_line no-margin">{{ $address->name }}</p>
                            <p class="chekcout-detail_line no-margin">{{ $address->phone }}</p>
                            <p class="chekcout-detail_line no-margin">{{ $address->address }}</p>
                            <p class="chekcout-detail_line no-margin">{{ $address->town }}</p>
                            <p class="chekcout-detail_line no-margin">{{ $address->country == 1? 'Srbija' : 'Hrvatska' }}</p>
                        </div>
                    </div>
                    <div class="checkout-detail">
                        <div class="checkout-detail_header">
                            <h4 class="text--bold text--sans-serif display-5 no-margin">Način dostave</h4>
                            <a class="icon-btn ml-auto" href="{{ url('placanje/nacin-slanja') }}" title="izmeni">
                                <svg class="icon">
                                    <use xlink:href="#icon_edit">
                                </svg>
                            </a>
                        </div>
                        <div class="checkout-detail_body">
                            <p class="chekcout-detail_line no-margin">{{ session('shipping') == 1? 'DHL' : 'PostExpress' }}</p>
                        </div>
                    </div>
                    <div class="checkout-detail">
                        <div class="checkout-detail_header">
                            <h4 class="text--bold text--sans-serif display-5 no-margin">Način plaćanja</h4>
                            <a class="icon-btn ml-auto" href="{{ url('placanje/nacin-placanja') }}" title="izmeni">
                                <svg class="icon">
                                    <use xlink:href="#icon_edit">
                                </svg>
                            </a>
                        </div>
                        <div class="checkout-detail_body">
                            <p class="chekcout-detail_line no-margin">{{ session('payment') == 1? 'Pouzećem' : 'Kreditna karta' }}</p>
                        </div>
                    </div>
                    <div class="checkout-detail">
                        <div class="checkout-detail_header">
                            <h4 class="text--bold text--sans-serif display-5 no-margin">Sadržaj korpe</h4>
                            <a class="icon-btn ml-auto"
                               href="/korpa"
                               title="izmeni"
                            >
                                <svg class="icon">
                                    <use xlink:href="#icon_edit">
                                </svg>
                            </a>
                        </div>
                        @if(count($cart)>0)
                            <div class="checkout-table-wrap">
                                <table class="checkout-table">
                                    <tr class="checkout-table_header">
                                        <th>Naziv</th>
                                        <th>Cena</th>
                                        <th>Kol.</th>
                                        <th>Ukupno</th>
                                    </tr>
                                    @foreach($cart as $product)
                                        <tr class="checkout-table_row">
                                            <td valign="top">
                                                <div class="shop-item_name">{{ $product->name }}</div>
                                                <div class="shop-item_brand">{{ $product->options->has('brand') ? $product->options->brand : '' }}</div>
                                            </td>
                                            <td valign="top">{{ $product->price }},00</td>
                                            <td valign="top">{{ $product->qty }}</td>
                                            <td valign="top">{{ $product->subtotal }},00</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </section>
                <form action="{{ route('checkout.step4') }}" method="POST">
                    @csrf
                    <button class="btn btn--primary" type="submit">poruči</button>
                </form>
            </div>
        </div>
    </div>
@endsection
