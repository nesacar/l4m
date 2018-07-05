@extends('themes.'.$theme.'.index')

@section('content')
  <div class="container">
    <div class="checkout">
      <div class="checkout-steps">
        {{-- stepper --}}
        @include('themes.'.$theme.'.pages.user.nav', ['active' => 'cart'])
      </div>
      <div class="checkout-content mb-4 py-1">
        <h3 class="display-3 text--uppercase text--sans-serif">Korpa</h3>
      </div>
    </div>
  </div>
@endsection
