@extends('themes.'.$theme.'.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    @include('themes.'.$theme.'.pages.client.hero')

    <div class="container client_products">
        <h2 class="display-3 section-title--serif">Akcija</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

        @if(count($products)>0)
            <div class="showcase_carousel client_showcase">
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
        @endif

        <a href="#" class="btn btn--primary">pogledajte sve</a>
    </div>

    @if(count($client->brand)>0)
        <div class="client_brands">
            <div class="container">
                <h2 class="display-3 section-title--serif">Brendovi</h2>
                <ul class="home_brands-list">
                    @foreach($client->brand as $brand)
                        <li class="home_brands-list-item">
                            <a href="{{ $brand->getLink() }}">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->title }}!">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(count($products)>0)
        <div class="container client_products client_products--border">
            <h2 class="display-3 section-title--serif">Akcija</h2>
            <div class="showcase_carousel client_showcase">
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

            <a href="#" class="btn btn--primary">pogledajte sve</a>
        </div>
    @endif

    @if(count($posts))
    <div class="home_discover-more">
        <div class="container">
            <h2 class="display-3 home_discover-more_title">Otkrij više</h2>
            @component('themes.' . $theme . '.components.grid', [
             'component' => 'blog.tile',
             'items' => $posts,
           ])
            @endcomponent
        </div>
    </div>
    @endif

@endsection