@extends('themes.' . $theme . '.index')

@section('content')

<div class="cart">
  @if(count($data) > 0)
  <section class="container">
    <h1 class="cart_heading cart_heading--1">Cart</h1>
    <p class="cart_secondary-text">You've got {{ $data['totalQty']}} items in the cart.</p>
  </section>
  <section class="container">
    <div class="cart_list">
      <div class="row collapse--md">
        <div class="col-md-6">Product</div>
        <div class="col-md-3">Quantity</div>
        <div class="col-md-3">Total</div>
      </div>
      @foreach($data['products'] as $id => $product)
        @cartitem(['product' => $product])
        @endcartitem
      @endforeach
    </div>
  </section>
  <section class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="cart_heading cart_heading--2">Cart totals</h2>
        <div class="receipt">
          <div class="receipt_fraction">
            <span class="receipt_key">subtotal</span>
            <span class="receipt_value">{{ $data['totalPrice'] }}</span>
          </div>
          <div class="receipt_fraction">
            <span class="receipt_key">shipping</span>
            <span class="receipt_value">flat rate</span>
          </div>
          <div class="receipt_fraction">
            <span class="receipt_key">total</span>
            <span class="receipt_value">{{ $data['totalPrice'] }}</span>
          </div>
        </div>
        <div class="cart_actions">
          <button class="btn btn--primary btn--block">update cart</button>
          <button class="btn btn--primary btn--block">checkout</button>
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="cart_heading cart_heading--2">You may also like</h2>
        <ul>
          <li>item</li>
        </ul>
      </div>
    </div>
  </section>
  @endif
</div>

@endsection
