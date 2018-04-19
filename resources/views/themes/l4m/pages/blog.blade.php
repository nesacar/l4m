@extends('themes.' . env('THEME_NAME','') . '.index')

@section('title'){{ $title }}@endsection

@section('content')
<style>
  .grid-wrap {
    display: flex;
  }
  .banner {
    width: 300px;
    height: 450px;
    background-color: #E0E0E0;
  }
  .demo {
    background-color: #9E9E9E;
  }
  .demo-img {
    background-color: #424242;
  }
  .hide {
    display: none;
  }
</style>
  <section class="container">
    <h2 class="section-title"><span>latest</span></h2>

    <div class="split-view">

      <div class="split-view_left-pane">
        @component('themes.' . env('THEME_NAME', '') . '.components.grid',
          [
            'component' => 'blog.tile',
            'items' => $items
          ]
        )
        @endcomponent
      </div>

      <aside class="split-view_right-pane" id="banner">
        <div class="banner">banner positions</div>
      </aside>

    </div>
  </section>

  <section class="showcase">
    <div class="container">

      <h4 class="section-title showcase_title">featured products</h4>

      <div class="simple-carousel-container">
        <div class="simple-carousel carousel">
          @foreach($products as $i => $product)
          <div class="carousel_item">
            @component('themes.' . env('THEME_NAME', '') . '.components.shop.item', [
              'product' => $product,
              '_index' => $i
            ])
            @endcomponent
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </section>

  <section class="container">
    <h2 class="section-title"><span>featured</span></h2>

    <div class="split-view">
      <div class="split-view_left-pane">
        @component('themes.' . env('THEME_NAME', '') . '.components.list', [
          'component' => 'blog.tile',
          'options' => (object)[
            'horizontal' => true,
            'asymmetric' => true
          ],
          'items' => $items
        ])
        @endcomponent
      </div>
      
      <div class="split-view_right-pane">
        @component('themes.' . env('THEME_NAME', '') . '.components.list', [
          'component' => 'blog.list-item',
          'items' => $items
          ])
        @endcomponent
      </div>
    
    </div>

  </section>
  <section class="container">
    <h2 class="section-title"><span>categories</span></h2>
  </section>
@endsection