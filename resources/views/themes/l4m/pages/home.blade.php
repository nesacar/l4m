@extends('themes.'.env('THEME_NAME', '').'.index')

@section('title'){{ $title }}@endsection

@section('content')

  @component('themes.' . env('THEME_NAME', '') . '.components.masthead-carousel', [
    'data' => $carouselData
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3" style="text-align:center;">Featured Products</h2>
    @component('themes.' . env('THEME_NAME', '') . '.components.tab-list', [
      'options' => (object)[
        'id' => 'featured'
      ]
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