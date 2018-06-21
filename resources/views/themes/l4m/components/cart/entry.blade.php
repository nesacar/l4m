@php $productItem = \App\Product::find($product->id); @endphp

<div class="cart_table-row cart_entry js-product" data-id="{{$product->id}}">
  <div class="cart_table-cell expand--md">
    <div class="shop-item_image">
      <div class="image image--square lazy-image"
        data-src="{{ url(\Imagecache::get($productItem->image, '90x120')->src) }}"
      ></div>
    </div>
  </div>
  <div class="cart_table-cell cart_entry-column">
    <div class="cart_item">
      <div class="shop-item_name">{{ $productItem->brand->title }}</div>
      <div class="shop-item_brand">{{ $productItem->title }}</div>
      <div class="shop-item_price" style="margin-top: auto;">
        <span class="shop-item_price-tag">
          {{ number_format($product->total, 2, ',', '.') }}
        </span>
      </div>
    </div>
  </div>
  <div class="cart_table-cell cart_entry-column">
    @counter([
      'id' => $product->id,
      'name' => 'Količina',
      'value' => $product->qty,
    ])
    @endcounter
  </div>
  <div class="cart_table-cell cart_entry-column expand--md">
    <span class="shop-item_price-tag">{{ number_format($product->total, 2, ',', '.') }}</span>
  </div>
  <div class="cart_table-cell cart_entry-column">
    <button class="icon-btn js-remove-entry" data-event="remove:cart">&times;</button>
  </div>
</div>