@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    @zoomer()
    @endzoomer
    <section class="container product js-product" data-id="{{ $product->id }}">
        <div class="expand--md">
            @include('themes.' . $theme . '.partials.breadcrumb')
        </div>

        <div class="row">
            <div class="col-12 collapse--md product_header product_header--mobile">
                <h1 class="product_name">{{ $product->brand->title }}</h1>
                <div class="product_brand">{{ $product->title }}</div>
            </div>
            <div class="col-md-6">
                @imagebox([ 'image' => $product->image, 'tmb' => $product->tmb, 'title' => $product->title, 'photos' => $product->photo ])@endimagebox
            </div>
            <div class="col-md-6">

                <div class="product_details">
                    <div class="expand--md product_header product_header--desktop">
                        <h1 class="product_name">{{ $product->brand->title }}</h1>
                        <div class="product_brand">{{ $product->title }}</div>
                    </div>
                    <div class="product_price">
                        @if($product->discount)
                            <span class="shop-item_price-tag shop-item_price-tag--invalid">@currency(['price' => $product->price]) @endcurrency</span>
                        @endif
                        <span class="shop-item_price-tag">@currency(['price' => $product->totalPrice]) @endcurrency</span>
                    </div>
                    <div class="product_section">
                        <div class="product_section-title">boja</div>
                        <div>
                            @color([
                              'colorName' => 'Zelena',
                              'colorValue' => 'olivedrab',
                            ])
                            @endcolor
                            @color([
                              'colorName' => 'Plava',
                              'colorValue' => 'royalblue',
                              'checked' => true,
                            ])
                            @endcolor
                            @color([
                              'colorName' => 'Siva',
                              'colorValue' => 'lightgray',
                            ])
                            @endcolor
                        </div>
                        <small class="product_section-follow-up">selected color name</small>
                    </div>
                    @if(count($sizes)>0)
                        <div class="product_section">
                            <div class="product_section-title">veličina</div>
                            <div>
                                @foreach($sizes as $size)
                                    @size(['label' => $size->title ,'value' => $size->id, 'checked' => false,])@endsize
                                @endforeach
                            </div>
                            <a class="product_section-follow-up" href="#">veličine</a>
                        </div>
                    @endif
                    <div class="product_actions">
                        <button class="btn btn--primary btn--block"
                                data-event="cart"
                        >dodaj u korpu
                        </button>
                        <button class="btn btn--outline btn--block"
                                data-event="wishlist"
                        >dodaj u listu želja
                        </button>
                    </div>
                    <div class="product_secondary-actions">
                        <div class="product_id">Šifra: {{ $product->code }}</div>
                        <div class="product_share">share:&nbsp;@social()</div>
                    </div>
                    @accordion(['product' => $product]) @endaccordion
                </div>

            </div>
        </div>
    </section>

    <!-- about brand -->
    @if(!empty($product->brand->body))
        <section class="container">
            <h2 class="display-3 brand_name">{{$product->brand->title}}</h2>
            <div class="brand_about js-collapse-container">
                <div class="brand_about-content js-collapse-content">
                    {!! $product->brand->body !!}
                </div>
            </div>
            <div style="text-align: center; padding: 8px 0;">
                <button class="icon-btn brand_about-toggle js-collapse-toggle" data-expanded="false">
                    <svg class="icon">
                        <use xlink:href="#icon_arrow">
                    </svg>
                </button>
            </div>
        </section>
    @endif
    <!-- /.about brand -->

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
