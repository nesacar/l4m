
<a href="{{ $product->getLink() }}" class="shop-item no-link">
  <div class="shop-item_actions">
    <button tabindex="-1" class="icon-btn shop-item_action-btn" title="add to favorites">
      <svg class="icon">
        <use xlink:href="#star-border">
      </svg>
    </button>
    <button tabindex="-1" class="icon-btn shop-item_action-btn" title="add to cart">
      <svg class="icon">
        <use xlink:href="#plus">
      </svg>
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
  <div class="shop-item_content">
    <div class="shop-item_name">{{ $product->title }}</div>
    <div class="shop-item_brand">{{ $product->brand->title }}</div>
    <div class="shop-item_price">
      @if($product->discount)
      <span class="shop-item_price-tag shop-item_price-tag--invalid">
        {{ $product->price_outlet }}
      </span>
      @endif
      <span class="shop-item_price-tag">
        {{ $product->price }}
      </span>
    </div>
  </div>
</a>