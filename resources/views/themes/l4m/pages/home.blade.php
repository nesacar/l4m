@extends('themes.' .  $theme .'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => [
      (object)[
        'image' => 'images/demo/dude.jpg',
        'category' => (object)[ 'title' => 'Dudes' ],
        'title' => 'The dude in the suit',
        'subtitle' => 'Look ma! A\'m wearing a suit on the beach.'
      ],
      (object)[
        'image' => 'images/demo/TH-sat.jpg',
        'category' => (object)[ 'title' => 'Watches' ],
        'title' => 'Watches on the Moon',
        'subtitle' => '\'cuz, why not?'
      ],
    ],
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

   {{--<section class="container">--}}
    {{--<h2 class="display-3" style="text-align: center;">Discover More</h2>--}}
    {{--@component('themes.' . env('THEME_NAME', '') . '.components.grid', [--}}
      {{--'component' => 'blog.tile',--}}
      {{--'items' => 'TODO Pass blog posts!'--}}
    {{--])--}}
    {{--@endcomponent--}}
  {{--</section>--}}

@endsection