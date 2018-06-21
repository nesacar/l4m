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
                      'disabled' => false,
                    ],
                  ],
                ])
                @endstepper
            </div>
            <div class="checkout-content my-4">
                <p>Plačanje je uspešno završwno.</p>
            </div>
        </div>
    </div>
@endsection
