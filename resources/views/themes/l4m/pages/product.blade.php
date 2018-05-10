@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    <section class="container product">
        @include('themes.' . $theme . '.partials.breadcrumb')

        <div class="row">
            <div class="col-md-6">
                @imagebox([ 'image' => $product->image, 'tmb' => $product->tmb, 'title' => $product->title, 'photos' => $product->photo ])@endimagebox
            </div>
            <div class="col-md-6">

                <div class="product_details">
                    <h1 class="display-3 product_name">{{ $product->brand->title }}</h1>
                    <div class="product_brand">{{ $product->title }}</div>
                    <div class="product_price">
                        @if($product->discount)
                            <span class="shop-item_price-tag shop-item_price-tag--invalid">{{ $product->price_outlet }}</span>
                        @endif
                        <span class="shop-item_price-tag">{{ $product->price }}</span>
                    </div>
                    <p class="product_description">{{ $product->short }}</p>
                    <div class="product_options">
                        @if(false)
                        <span>
                          <label for="count">Quantity:</label>
                            @counter([ 'name' => 'quantity', 'id' => 'quantity', 'value' => 1 ])@endcounter
                        </span>
                        @endif
                        <span>
                            <label for="size">Size:</label>
                            @select([ 'name' => 'size', 'id' => 'size' ])
                            <option value="onesize" selected>one size</option>
                            @endselect
                        </span>
                    </div>
                    <div class="product_actions">
                        <button class="btn btn--primary btn--block">dodaj u korpu</button>
                        <button class="btn btn--outline btn--block">dodaj u listu želja</button>
                    </div>
                    <div class="product_social">
                        @social()
                    </div>
                    <div class="product_id">Item id: {{ $product->code }}</div>
                </div>

            </div>
        </div>

        <div class="tabs tabs--center product_info">
            <input class="tab_control" type="radio" name="product-details" id="desc-tab" checked>
            <label class="tab_label" for="desc-tab">OPIS</label>
            @if($product->body2)
            <input class="tab_control" type="radio" name="product-details" id="info-tab">
            <label class="tab_label" for="info-tab">DODATAN OPIS</label>
            @endif
            {{--<input class="tab_control" type="radio" name="product-details" id="reviews-tab">--}}
            {{--<label class="tab_label" for="reviews-tab">REVIEWS</label>--}}

            <div class="tab_content" id="desc-content">
                {!! $product->body !!}
            </div>
            @if($product->body2)
            <div class="tab_content" id="info-content">
                {!! $product->body2 !!}
            </div>
            @endif
            {{--<div class="tab_content" id="reviews-content">--}}
                {{--reviews...--}}
            {{--</div>--}}
        </div>
    </section>

    <section class="showcase">
        <div class="container">

            <h2 class="display-3 section-title--serif">Related Products</h2>

            <div class="showcase_carousel">
                @foreach($related as $i => $product)
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

@section('scripts')
  <script src="{{ url('themes/' . $theme . '/js/product.js') }}"></script>
@endsection
