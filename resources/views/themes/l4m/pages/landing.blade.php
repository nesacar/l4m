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

@endsection