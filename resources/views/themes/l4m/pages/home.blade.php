@extends('themes.' .  $theme .'.index')

@section('title') Luxury 4 Me @endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Featured Products</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.tab-list', [
      'list' => $products,
      'options' => (object)[
        'id' => 'featured'
      ]
    ])
    @endcomponent
  </section>

  <div class="container">
    @include('themes.' . env('THEME_NAME', '') . '.partials.categories', [
      'categories',
      'options' => (object)[ 'big' => true ]
      ])
  </div>

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Latest Products</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.tab-list', [
      'list' => $products,
      'options' => (object)[
        'id' => 'latest'
      ]
    ])
    @endcomponent
  </section>

@endsection