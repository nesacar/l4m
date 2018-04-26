@extends('themes.' .  $theme .'.index')

@section('title') Luxury 4 Me @endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Featured Products</h2>
    @include('themes.' . env('THEME_NAME', '') . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'featured'
      ]
    ])
  </section>

  <section class="container categorie-container">
    @include('themes.' . env('THEME_NAME', '') . '.partials.categories', [
      'categories',
      'options' => (object)[ 'big' => true ]
      ])
  </section>

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Latest Products</h2>
    @include('themes.' . env('THEME_NAME', '') . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'latest'
      ]
    ])
  </section>

  {{-- <section class="container">
    <h2 class="display-3" style="text-align: center;">Discover More</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.grid', [
      'component' => 'blog.tile',
      'items' => 'TODO Pass blog posts!'
    ])
    @endcomponent
  </section> --}}

@endsection