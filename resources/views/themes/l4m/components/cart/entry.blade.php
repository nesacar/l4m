<div class="row cart_entry">
  <div class="col-md-6 cart_entry-column">
    <span class="collapse--md cart_secondary-text">proizvod</span>
    @cartitem([ 'product' => $product])
    @endcartitem
  </div>
  <div class="col-md-3 cart_entry-column">
    <label class="collapse--md cart_secondary-text" for="{{ $product->id }}">Kolicina:</label>
    @counter([
      'id' => $product->id,
      'name' => 'Količina',
      'value' => $product->qty,
    ])
    @endcounter
  </div>
  <div class="col-md-3 cart_entry-column">
    <span class="collapse--md cart_secondary-text">total</span>
    <span class="shop-item_price-tag">{{ number_format($product->total, 2, ',', '.') }}</span>
  </div>
</div>