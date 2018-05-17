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

      {{-- @include('themes.' . $theme . '.partials.breadcrumb') --}}

      <div class="shop-results_header">
        {{-- <div class="shop-results_count">Showing 1-15 of {{ $data['count'] }} results</div> --}}
        {{-- @select([ 'name' => 'sort', 'id' => 'sort', 'form' => 'filters' ])
          <option value="1" {{ request('sort') == 1? 'selected' : '' }}>Najnovije</option>
          <option value="2" {{ request('sort') == 2? 'selected' : '' }}>Cena rastuce</option>
          <option value="3" {{ request('sort') == 3? 'selected' : '' }}>Cena opadajuce</option>
        @endselect --}}

        <div class="shop_sort-options">
          <div class="shop_sort-label">Sortiraj po:</div>
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

        {{ $data['products']->appends(Request::all())->links() }}

      </div>
    
      <div class="row">
        <aside class="col-lg-3 filters-container">
          @include('themes.' . $theme . '.partials.filters')
        </aside>

        <div class="col-lg-9">

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

    </div>

  </section>

@endsection

@section('scripts')
  <script src="{{ url('themes/' . $theme . '/js/shop.js') }}"></script>
@endsection