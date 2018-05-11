@extends('themes.' . $theme . '.index')

@section('content')

  <section class="container">
    <h1>Cart</h1>
    <div>You've got 2 items in the cart.</div>
  </section>
  <section class="container">
    <ul>
      <li>
        item
      </li>
    </ul>
  </section>
  <section class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Cart totals</h2>
        <div>
          <div>
            <span>subtotal</span>
            <span>40.00</span>
          </div>
          <div>
            <span>shipping</span>
            <span>40.00</span>
          </div>
          <div>
            <span>total</span>
            <span>40.00</span>
          </div>
        </div>
        <button>update cart</button>
        <button>checkout</button>
      </div>
      <div class="col-md-6">
        <h2>You may also like</h2>
        <ul>
          <li>item</li>
        </ul>
      </div>
    </div>
  </section>

@endsection
