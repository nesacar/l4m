@extends('themes.' .  $theme .'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  @component('themes.' . $theme . '.components.masthead-carousel', [
    'data' => $slider,
    'options' => (object)[
      'controls' => false,
      'fullWidth' => true,
    ],
  ])
  @endcomponent

  <section class="container">
    <h2 class="display-3 section-title--serif">Istaknuti proizvodi</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'featured'
      ],
      'bars' => $featuredProducts
    ])
  </section>

  <section class="container">
    <div class="row home_categories">
      @foreach($categories as $category)
      <a href="{{ url('shop/' . $category->slug) }}" class="col-md-3 home_category with-flare with-scrim">
        <div class="image image--portrait home_category-image">
          <img src="{{ url($category->box_image) }}" alt="{{ $category->title }}">
        </div>
        <div class="home_category-title">
          <h3 class="home_category-text home_category-text--underline">{{ $category->title }}</h3>
        </div>
      </a>
      @endforeach
    </div>
  </section>

  @if(false)
  <section class="home_brands">
    <div class="container">
      <h2 class="display-3 section-title--serif">Brendovi</h2>
      <ul class="home_brands-list">
      @for($i = 0; $i < 12; $i++)
        <li class="home_brands-list-item">
          <a href="#">
            <img src="{{ url('/storage/uploads/tmp/ft.png') }}" alt="ft">
          </a>
        </li>
      @endfor
      </ul>
    </div>
  </section>
  @endif

  <section class="container">
    <h2 class="display-3 section-title--serif">Najnoviji proizvodi</h2>
    @include('themes.' . $theme . '.partials.tab-list', [
      'options' => (object)[
        'id' => 'latest'
      ],
      'bars' => $latestProducts
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