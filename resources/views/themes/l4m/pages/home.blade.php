@extends('themes.' .  $theme .'.index')

@section('title') Luxury 4 Me @endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Featured Products</h2>
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
    <h2 class="display-3" style="text-align:center;">Latest Products</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'latest'
      ],
      'bars' => $latestProducts
    ])
  </section>

@endsection