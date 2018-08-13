@extends('themes.'.$theme.'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  <section class="container">
    @include('themes.' .$theme . '.partials.categories', [
      'categories',
    ])
  </section>

  <section class="container">
    <h2 class="display-3 section-title--serif">Žene</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'zene'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="container">
    <h2 class="display-3 section-title--serif">Muškarci</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'muskarci'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="container">
    <h2 class="display-3 section-title--serif">Deca</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'deca'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="container">
    <h2 class="display-3 section-title--serif">Living</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'living'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  @if(count($brands)>0)
      <section class="home_brands">
          <div class="container">
              <h2 class="display-3 section-title--serif">Brendovi</h2>
              <ul class="home_brands-list">
                  @foreach($brands as $brand)
                      <li class="home_brands-list-item">
                          <a href="{{ url('brendovi/' . $brand->slug) }}">
                              <img src="{{ url($brand->logo) }}" alt="{{ $brand->title }}">
                          </a>
                      </li>
                  @endforeach
              </ul>
          </div>
      </section>
  @endif

  <section class="container">
    <h2 class="display-3 section-title--serif">Istaknuti proizvodi</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'featured',
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="home_discover-more">
    <div class="container">
        <h2 class="display-3 home_discover-more_title">Pogledajte više</h2>
        @component('themes.' . $theme . '.components.grid', [
          'component' => 'blog.tile',
          'items' => $posts,
        ])
        @endcomponent
    </div>
  </section>

@endsection