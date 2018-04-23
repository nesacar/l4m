@extends('themes.'.env('THEME_NAME', '').'.index')

@section('title'){{ $title }}@endsection

@section('content')

  @component('themes.' . env('THEME_NAME', '') . '.components.masthead-carousel', [
    'data' => $carouselData
  ])
  @endcomponent

  <section class="container">

    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $products
    ])
    @endcomponent

  </section>

@endsection