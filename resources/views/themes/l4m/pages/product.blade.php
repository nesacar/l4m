@extends('themes.' . env('THEME_NAME', '') . '.index')

@section('title'){{ $title }}@endsection

@section('content')
  <section class="container product">
    @include('themes.' . env('THEME_NAME', '') . '.partials.breadcrumb')
    
    <div class="row">
      <div class="col-md-7">
        @imagebox([ 'image' => $product->image ])
        @endimagebox
      </div>
      <div class="col-md-5">
        
        <div class="product_details">
          <h1 class="display-3 product_name">{{ $product->title }}</h1>
          <div class="product_brand">{{ $product->brand->title }}</div>
          <div class="product_price">
            @if($product->discount)
            <span class="shop-item_price-tag shop-item_price-tag--invalid">
              {{ $product->price_outlet }}
            </span>
            @endif
            <span class="shop-item_price-tag">
              {{ $product->price }}
            </span>
          </div>
          <p class="product_description">{{ $product->short }}</p>
          <button class="btn btn--primary btn--block">add to cart</button>
          <div class="product_actions">
            <button class="btn btn--outline">
              <svg class="icon">
                <use xlink:href="#star-border">
              </svg>
            </button>
            @social()
          </div>
          <div class="product_id">Item id: {{ $product->id }}</div>
        </div>

      </div>
    </div>

    <div class="tabs tabs--center product_details">
      <input class="tab_control" type="radio" name="product-details" id="desc-tab" checked>
      <label class="tab_label" for="desc-tab">DESCRIPTION</label>
      <input class="tab_control" type="radio" name="product-details" id="info-tab">
      <label class="tab_label" for="info-tab">ADDITIONAL INFORMATION</label>
      <input class="tab_control" type="radio" name="product-details" id="reviews-tab">
      <label class="tab_label" for="reviews-tab">REVIEWS</label>

      <div class="tab_content" id="desc-content">
        {{ $product->body }}
      </div>
      <div class="tab_content" id="info-content">
        {{ $product->body2 }}
      </div>
      <div class="tab_content" id="reviews-content">
        reviews...
      </div>
    </div>
  </section>
  <section class="showcase">
    <div class="container">

      <h2 class="display-3 section-title--serif">Related Products</h2>

        <div class="showcase_carousel">
          @foreach($products as $i => $product)
          <div class="showcase_item">
            @component('themes.' . $theme . '.components.shop.item', [
              'product' => $product,
              'theme' => $theme,
              '_index' => $i
            ])
            @endcomponent
          </div>
          @endforeach
        </div>

    </div>
  </section>
@endsection