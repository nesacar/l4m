@extends('themes.' .  $theme .'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider,
    'options' => (object)[
      'controls' => false,
      'fullWidth' => true,
    ],
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3 section-title--serif">Featured Products</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'featured'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="container categorie-container">
    @include('themes.' . $theme . '.partials.categories', [
      'categories',
      'options' => (object)[ 'big' => true ]
      ])
  </section>

  <section class="container">
    <h2 class="display-3 section-title--serif">Latest Products</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'latest'
      ],
      'bars' => $latestProducts
    ])
  </section>

  <section class="home_discover-more">
    <div class="container">
      <h2 class="display-3 home_discover-more_title">Discover More</h2>
      @component('themes.' . $theme . '.components.grid', [
        'component' => 'blog.tile',
        'items' => $posts,
      ])
      @endcomponent
    </div>
  </section>

@endsection