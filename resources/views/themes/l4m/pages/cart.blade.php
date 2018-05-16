@extends('themes.' . $theme . '.index')

@section('content')

<div class="cart">
  @if(count($data) > 0)
  <section class="container">
    <h1 class="cart_heading cart_heading--1">Korpa</h1>
    <p class="cart_secondary-text">Imate {{ $data['totalQty']}} {{ $data['totalQty']%10 == 1 ? 'proizvod' : 'proizvoda'  }} u korpi.</p>
  </section>
  <section class="container">
    <div class="cart_list">
      <div class="row expand--md cart_secondary-text">
        <div class="col-md-6">Proizvod</div>
        <div class="col-md-3">Količina</div>
        <div class="col-md-3">Ukupno</div>
      </div>
      <hr>
      @foreach($data['products'] as $id => $product)
        @cartentry(['product' => $product]) @endcartentry
        <hr>
      @endforeach
    </div>
  </section>
  <section class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="cart_heading cart_heading--2">Ukupno u korpi</h2>
        <div class="receipt">
          <div class="receipt_fraction">
            <span class="receipt_key">cena</span>
            <span class="receipt_value shop-item_price-tag">{{ $data['totalPrice'] }}</span>
          </div>
          <div class="receipt_fraction">
            <span class="receipt_key">dostava</span>
            <span class="receipt_value">besplatna</span>
          </div>
          <div class="receipt_fraction">
            <span class="receipt_key">ukupno</span>
            <span class="receipt_value shop-item_price-tag">{{ $data['totalPrice'] }}</span>
          </div>
        </div>
        <div class="cart_actions">
          <button class="btn btn--primary btn--block">primenite izmene</button>
          <button class="btn btn--primary btn--block">Idite na plaćanje</button>
        </div>
      </div>
      <div class="col-md-6">
        {{--<h2 class="cart_heading cart_heading--2">You may also like</h2>--}}
        {{--<ul>--}}
          {{--<li>item</li>--}}
        {{--</ul>--}}
      </div>
    </div>
  </section>
  @endif
</div>

@endsection
