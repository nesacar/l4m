@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  <section class="container">

    <h1 class="display-3 shop-title">{{ $category->title }}</h1>

      @component('themes.' . $theme . '.components.shop.header', [
        'img' => $category->image,
        'name' => $category->title
      ])
      @endcomponent

       @include('themes.' . $theme . '.partials.breadcrumb')

      <div class="shop-results_header">
        <div class="collapse--md shop_filter-btn">Filteri</div>
        <div class="shop_sort-options">
          <div class="shop_sort-label">Sortiraj po:</div>
          <div class="shop_sort-options-wrap">
            <div class="shop_sort-option">
              <input
                type="radio"
                name="sort"
                id="najnovije"
                value="1"
                form="filters"
                {{ request('sort') == 1? 'checked' : '' }}
              >
              <label for="najnovije">Najnovije</label>
            </div>
            <div class="shop_sort-option">
              <input
                type="radio"
                name="sort"
                id="rastuce"
                value="2"
                form="filters"
                {{ request('sort') == 2? 'checked' : '' }}
              >
              <label for="rastuce">Cena rastuće</label>
            </div>
            <div class="shop_sort-option">
              <input
                type="radio"
                name="sort"
                id="opadajuce"
                value="3"
                form="filters"
                {{ request('sort') == 3? 'checked' : '' }}
              >
              <label for="opadajuce">Cena opadajuće</label>
            </div>
          </div>
        </div>

        <div class="expand--md">
          {{ $data['products']->appends(Request::all())->links() }}
        </div>

      </div>
    
      <div class="row">
        <aside class="col-lg-3 col-md-4 filters-container">
          @include('themes.' . $theme . '.partials.filters')
        </aside>

        <div class="col-lg-9 col-md-8">

          @component('themes.' . $theme . '.components.shop.grid', [
            'component' => 'shop.item',
            'items' => $data['products'],
            'category' => $category,
            'options' => (object)[ 'shop' => true ]
          ])
          @endcomponent
        </div>
        
      </div>

      <nav class="pagination-container" aria-label="shop navigation">
        {{ $data['products']->appends(Request::all())->links() }}
      </nav>

  </section>

@endsection

@section('scripts')
  <script src="{{ url('themes/' . $theme . '/js/shop.js') }}"></script>
@endsection