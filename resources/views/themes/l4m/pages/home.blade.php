@extends('themes.' .  $theme .'.index')

@section('title') Luxury 4 Me @endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider
  ])
  @endcomponent

  <section class="container">
<<<<<<< HEAD
    <h2 class="display-3" style="text-align:center;">Featured Products</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.tab-list', [
      'options' => (object)[
        'id' => 'featured'
      ]
=======

    @component('themes.' . $theme . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $products
>>>>>>> d83a13ab4a0e881f9a56b5c09d79b24cf7f5a001
    ])
    @endcomponent
  </section>

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Latest Products</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.tab-list', [
      'options' => (object)[
        'id' => 'latest'
      ]
    ])
    @endcomponent
  </section>

@endsection