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
              'link' => '/checkout/address',
              'text' => 'Adresa slanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/shipping',
              'text' => 'Način slanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/payment',
              'text' => 'Način plaćanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/confirmation',
              'text' => 'Potvrda porudžbine',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/checkout',
              'text' => 'Kraj',
              'disabled' => false,
            ],
          ],
        ])
        @endstepper
      </div>
      <div class="checkout-content" style="margin-top: 32px;">
        checkout
      </div>
    </div>
  </div>
@endsection
