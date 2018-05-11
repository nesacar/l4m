<div class="row">
  <div class="col-md-6">
    {{ $product['item']->title }}
  </div>
  <div class="col-md-3">
    @counter([
      'id' => $product['item']->id,
      'name' => 'count',
      'value' => $product['qty'],
    ])
    @endcounter
  </div>
  <div class="col-md-3">{{ $product['price'] }}</div>
</div>
