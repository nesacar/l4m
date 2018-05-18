@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    <section class="container product js-product" data-id="{{ $product->id }}">
      <div class="expand--md">
        @include('themes.' . $theme . '.partials.breadcrumb')
      </div>

        <div class="row">
            <div class="col-12 collapse--md product_header--mobile">
                <h1 class="product_name">{{ $product->brand->title }}</h1>
                <div class="product_brand">{{ $product->title }}</div>
            </div>
            <div class="col-md-6">
                @imagebox([ 'image' => $product->image, 'tmb' => $product->tmb, 'title' => $product->title, 'photos' => $product->photo ])@endimagebox
            </div>
            <div class="col-md-6">

                <div class="product_details">
                    <div class="expand--md">
                        <h1 class="product_name">{{ $product->brand->title }}</h1>
                        <div class="product_brand">{{ $product->title }}</div>
                    </div>
                    <div class="product_price">
                        @if($product->discount)
                            <span class="shop-item_price-tag shop-item_price-tag--invalid">{{ number_format($product->price, 2, ',', '.') }}</span>
                        @endif
                        <span class="shop-item_price-tag">{{ number_format($product->totalPrice, 2, ',', '.') }}</span>
                    </div>
                    <div class="product_options">
                        @if(false)
                            <span>
                          <label for="count">Quantity:</label>
                                @counter([ 'name' => 'quantity', 'id' => 'quantity', 'value' => 1 ])@endcounter
                        </span>
                            <span>
                            <label for="size">Size:</label>
                                @select([ 'name' => 'size', 'id' => 'size' ])
                                <option value="onesize" selected>one size</option>
                                @endselect
                        </span>
                        @endif
                    </div>
                    <div class="product_actions">
                        <button class="btn btn--primary btn--block"
                          data-event="cart"
                        >dodaj u korpu
                        </button>
                        <button class="btn btn--outline btn--block"
                          data-event="wishlist"
                        >dodaj u listu želja</button>
                    </div>
                    <div class="product_id">Šifra: {{ $product->code }}</div>
                    @accordion(['product' => $product]) @endaccordion
                    <div class="product_social">
                        @social()
                    </div>
                </div>

            </div>
        </div>

        @if(false)
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
        @endif
    </section>

    <section class="showcase">
        <div class="container">

            <h2 class="display-3 section-title--serif">Povezani proizvodi</h2>

            <div class="showcase_carousel">
                @foreach($related as $i => $product)
                    <div class="showcase_item">
                        @component('themes.' . $theme . '.components.shop.item', [
                          'product' => $product,
                          'category' => $category,
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
