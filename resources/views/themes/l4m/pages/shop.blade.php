@extends('themes.' . env('THEME_NAME', '') . '.index')

@section('title'){{ $title }}@endsection

@section('content')

  <section class="container">
    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $products,
      'options' => (object)[
        'shop' => true
      ]
    ])
    @endcomponent
  </section>

@endsection