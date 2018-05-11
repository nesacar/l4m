<div class="row cart_entry">
  <div class="col-md-6 cart_entry-column">
    <span class="collapse--md cart_secondary-text">product</span>
    @cartitem([ 'product' => $product['item']])
    @endcartitem
  </div>
  <div class="col-md-3 cart_entry-column">
    <label class="collapse--md cart_secondary-text" for="{{$product['item']->id }}">Kolicina:</label>
    @counter([
      'id' => $product['item']->id,
      'name' => 'count',
      'value' => $product['qty'],
    ])
    @endcounter
  </div>
  <div class="col-md-3 cart_entry-column">
    <span class="collapse--md cart_secondary-text">total</span>
    <span class="shop-item_price-tag">{{ $product['price'] }}</span>
  </div>
</div>