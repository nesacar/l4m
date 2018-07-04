@extends('themes.' . $theme . '.index')

@section('content')
  <div class="container">
    <h2 class="display-2 text--sans-serif">Wishlist</h2>
    <div class="checkout">
      <div class="checkout-steps">
        @include('themes.'.$theme.'.pages.user.nav')
      </div>
      <div class="checkout-content mb-4 py-1">
        wishlist items...
      </div>
    </div>
  </div>
@endsection