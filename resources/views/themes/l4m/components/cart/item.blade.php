@php $productItem = \App\Product::find($product->id); @endphp

<div class="shop-item_container shop-item_container--horizontal">
  <div class="shop-item_image cart_item-image">
    <div class="image image--square lazy-image"
      data-src="{{ url(\Imagecache::get($productItem->image, '90x120')->src) }}"
    ></div>
  </div>
  <div class="shop-item_content">
    <div class="shop-item_name">{{ $productItem->brand->title }}</div>
    <div class="shop-item_brand">{{ $productItem->title }}</div>
    <div class="shop-item_price" style="margin-top: auto;">
      <span class="shop-item_price-tag">
        {{ number_format($product->total, 2, ',', '.') }}
      </span>
    </div>
  </div>
</div>
