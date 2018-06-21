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
                      'link' => '/placanje/nacim-placanja',
                      'text' => 'Način plaćanja',
                      'disabled' => true,
                    ],
                    (object)[
                      'link' => '/placanje/potvrda-porudzbine',
                      'text' => 'Potvrda porudžbine',
                      'disabled' => true,
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
                <section class="checkout-details mb-2">
                    <div class="checkout-detail">
                        <div class="checkout-detail_header">
                            <h4 class="text--bold text--sans-serif display-5 no-margin">
                                Način dostave
                            </h4>
                        </div>
                        <div class="checkout-detail_body">
                            <div class="checkout-detail_line">
                                @radio([
                                  'id' => 'radio-1',
                                  'name' => 'shipping',
                                  'value' => 'dhl',
                                  'checked' => true,
                                  'label' => 'DHL',
                                ])
                                @endradio
                            </div>
                            <div class="checkout-detail_line">
                                @radio([
                                  'id' => 'radio-2',
                                  'name' => 'shipping',
                                  'value' => 'post-express',
                                  'label' => 'PostExpress',
                                ])
                                @endradio
                            </div>
                        </div>
                    </div>
                </section>
                <a class="btn btn--primary"
                   href="/checkout/payment"
                >nastavi</a>
            </div>
        </div>
    </div>
@endsection
