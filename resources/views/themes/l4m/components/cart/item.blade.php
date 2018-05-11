<div class="shop-item_container shop-item_container--horizontal">
  <div class="shop-item_image cart_item-image">
    <div class="image image--portrait lazy-image"
      data-src="{{ url(\Imagecache::get($product->image, '215x287')->src) }}"
    ></div>
  </div>
  <div class="shop-item_content">
    <div class="shop-item_name">{{ $product->brand->title }}</div>
    <div class="shop-item_brand">{{ $product->title }}</div>
    <div class="shop-item_price" style="margin-top: auto;">
      <span class="shop-item_price-tag">
        {{ $product->totalPrice }}
      </span>
    </div>
  </div>
</div>
