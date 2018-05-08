@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

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
  @component('themes.' . $theme . '.components.masthead-carousel', ['data' => $slider])@endcomponent

  <section class="container">
    <h2 class="section-title with-lines"><span>latest</span></h2>

    <div class="split-view">

      <div class="split-view_left-pane">
        @component('themes.' . $theme . '.components.grid',
          [
            'component' => 'blog.tile',
            'theme' => $theme,
            'items' => $posts->take(6)
          ]
        )
        @endcomponent
      </div>

      @if(false)
      <aside class="split-view_right-pane" id="banner">
        <div class="banner">banner positions</div>
      </aside>
      @endif

    </div>
  </section>

  <section class="showcase">
    <div class="container">

      <h4 class="section-title showcase_title">featured products</h4>

        <div class="showcase_carousel">
          @foreach($featuredProducts->first()->product as $i => $product)
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

  <section class="container">
    <h2 class="section-title with-lines"><span>featured</span></h2>
    
    <div class="split-view">
      <div class="split-view_left-pane">
        @component('themes.' . $theme . '.components.list', [
          'component' => 'blog.tile',
          'options' => (object)[
            'horizontal' => true,
            'asymmetric' => true
          ],
          'items' => $posts->slice(6)
        ])
        @endcomponent
      </div>
      
      <aside class="split-view_right-pane">
        <div class="with-border">
          <h4 class="side-content-title">most viewed posts</h4>
          @component('themes.' . $theme . '.components.list', [
            'component' => 'blog.list-item',
            'items' => $mostView,
            'theme' => $theme
            ])
          @endcomponent
        </div>
        @include('themes.' . $theme . '.partials.newsletter')
        <div class="social-container">
          @social()
        </div>
      </aside>
    
    </div>

  </section>
  <section class="container categorie-container">
    <h2 class="section-title with-lines"><span>categories</span></h2>
    @include('themes.' .$theme . '.partials.categories', [
      'categories',
      'options' => (object)[ 'small' => true ]
    ])
  </section>
@endsection