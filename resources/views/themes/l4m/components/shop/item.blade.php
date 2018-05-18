@php

 $isHorizontal = false;

 if (isset($options)) {
   $isHorizontal = isset($options->horizontal) ? $options->horizontal : $isHorizontal;
 }

 $className = 'shop-item_container' . ($isHorizontal ? ' shop-item_container--horizontal' : '');

  $product = isset($item) 
  ? isset($product) ? $product : $item
  : $product;

@endphp

<a href="{{ $product->getLink(isset($category)? $category : false) }}" data-id="{{ $product->id }}" class="shop-item no-link js-product">
  <div class="{{ $className }}">
    <div class="shop-item_presentation">
      <div class="shop-item_actions">
        <button tabindex="-1" data-event="wishlist" class="icon-btn shop-item_action-btn" title="add to favorites">
          <svg class="icon">
            <use xlink:href="#icon_star-border">
          </svg>
        </button>
        <button tabindex="-1" data-event="cart" class="icon-btn shop-item_action-btn" title="add to cart">
          <div class="icon-plus">
            <span></span>
            <span></span>
          </div>
        </button>
      </div>
      @if($product->discount)
        <span class="shop-item_discount-tag">{{ $product->discount }}</span>
      @endif
      <div class="shop-item_image">
        <div class="image image--portrait lazy-image"
          data-src="{{ url(\Imagecache::get($product->image, '215x287')->src) }}"
        ></div>
      </div>
    </div>
    <div class="shop-item_content">
      <div class="shop-item_name">{{ $product->brand->title }}</div>
      <div class="shop-item_brand">{{ $product->title }}</div>
      <div class="shop-item_price">
        @if($product->discount)
        <div class="shop-item_price-tag shop-item_price-tag--invalid">
          {{ number_format($product->price, 2, ',', '.') }}
        </div>
        <div class="shop-item_price-tag">
          {{ $product->totalPrice }}
        </div>
        @else
        <div class="shop-item_price-tag">
          {{ $product->totalPrice }}
        </div>
        @endif
      </div>
    </div>
  </div>
</a>