@extends('themes.' . $theme . '.index')

@php
  $src = "http://l4m.mia.rs/storage/imagecache/215x287/storage/uploads/galleries/aisha-386/aisha-386-iz7L.jpg";
@endphp

@section('content')
  <div class="container">
    <div class="checkout">
      <div class="checkout-steps">
        @include('themes.'.$theme.'.pages.user.nav', ['active' => 'wishlist'])
      </div>
      <div class="checkout-content mb-4 py-1">
        <h3 class="display-3 text--uppercase text--sans-serif">wishlist</h3>
        @wishlisttable(['products' => $products])
        @endwishlisttable
      </div>
    </div>
  </div>
@endsection
