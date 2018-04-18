@php

  $priceWithDiscount = 0;
  $hasDiscount = isset($product->discount);

  $name = isset($product->name) ? $product->name : 'Product name';
  $brand = isset($product->brand) ? $product->brand : 'Brand';
  $price = isset($product->price) ? $product->price : 0;
  $discount = $hasDiscount ? $product->discount : 0;
  $img = isset($product->img) ? $product->img : '#';

  $priceWithDiscount = $price - (($discount / 100) * $price);

@endphp

<div class="shop-item">
  @if($hasDiscount)
    <span class="shop-item_discount-tag">{{ $discount }}</span>
  @endif
  <div class="shop-item_image">
    <div class="image image--portrait lazy-image"
      data-src="{{ $img }}"
    ></div>
  </div>
  <div class="shop-item_content">
    <div class="shop-item_name">{{ $name }}</div>
    <div class="shop-item_brand">{{ $brand }}</div>
    <div class="shop-item_price">
      @if($hasDiscount)
      <span class="shop-item_price-tag shop-item_price-tag--invalid">
        {{ $price }}
      </span>
      @endif
      <span class="shop-item_price-tag">
        {{ $priceWithDiscount }}
      </span>
    </div>
  </div>
</div>