@extends('themes.' . env('THEME_NAME', '') . '.index')

@section('title'){{ $title }}@endsection

@section('content')

  <section class="container">

    <h1 class="display-3 shop-title">fashion</h1>

      @component('themes.' .env('THEME_NAME', '') . '.components.shop.header', [
        'img' => 'http://www.joyline-global.com/storefiles/gallery/Homepage%20Banner/cd4cb4fb-52f1-4cc3-a1a7-88a6ae382ca5home%20page%20banner%20new.png',
        'name' => 'Fashion'
      ])
      @endcomponent

      @include('themes.' . env('THEME_NAME', '') . '.partials.breadcrumb')
    
      <div class="shop-shop">
        <aside class="shop-shop_filters">
          @include('themes.' . env('THEME_NAME', '') . '.partials.filters')
        </aside>

        <div class="shop-shop_items">
          @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
            'component' => 'shop.item',
            'items' => $products,
            'options' => (object)[
              'shop' => true
            ]
          ])
          @endcomponent
        </div>
        
      </div>

      @include('themes.' . env('THEME_NAME', '') . '.partials.pagination')

    </div>

  </section>

@endsection