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
                <form action="{{ route('checkout.step3') }}" method="POST">
                    @csrf
                    <section class="checkout-details mb-2">
                        <div class="checkout-detail">
                            <div class="checkout-detail_header">
                                <h4 class="text--bold text--sans-serif display-5 no-margin">
                                    Način plaćanja
                                </h4>
                            </div>
                            <div class="checkout-detail_body">
                                <div class="checkout-detail_line">
                                    @radio([
                                      'id' => 'radio-1',
                                      'name' => 'payment',
                                      'value' => 1,
                                      'checked' => true,
                                      'label' => 'Pouzećem',
                                    ])
                                    @endradio
                                </div>
                                <div class="checkout-detail_line">
                                    @radio([
                                      'id' => 'radio-2',
                                      'name' => 'payment',
                                      'value' => 2,
                                      'checked' => false,
                                      'label' => 'Platnom karticom',
                                    ])
                                    @endradio
                                </div>
                            </div>
                        </div>
                    </section>
                    <button class="btn btn--primary" type="submit">nastavi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
