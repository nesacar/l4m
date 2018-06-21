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
            <form action="{{ route('checkout.step2') }}" method="POST">
                @csrf
                <div class="checkout-content my-4">
                    <section class="checkout-details mb-2">
                        <div class="checkout-detail">
                            <div class="checkout-detail_header">
                                <h4 class="text--bold text--sans-serif display-5 no-margin">
                                    Način dostave
                                </h4>
                            </div>
                            @if(count($shippings)>0)
                                <div class="checkout-detail_body">
                                    @foreach($shippings as $shipping)
                                        <div class="checkout-detail_line">
                                            @radio([
                                              'id' => 'radio-' . $shipping->id,
                                              'name' => 'shipping',
                                              'value' => $shipping->id,
                                              'checked' => true,
                                              'label' => $shipping->title,
                                            ])
                                            @endradio
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                    <button class="btn btn--primary" type="submit">nastavi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
