@extends('themes.' .  $theme .'.index')

@section('title') Luxury 4 Me @endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider
  ])
  @endcomponent

  <section class="container">

    @component('themes.' . $theme . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $products
    ])
    @endcomponent

  </section>

@endsection