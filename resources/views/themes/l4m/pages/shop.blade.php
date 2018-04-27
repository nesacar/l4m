@extends('themes.' . $theme . '.index')

@section('title') Luxury 4 Me - Shop @endsection

@section('content')

  <section class="container">

    <h1 class="display-3 shop-title">fashion</h1>

      @component('themes.' . $theme . '.components.shop.header', [
        'img' => 'http://www.joyline-global.com/storefiles/gallery/Homepage%20Banner/cd4cb4fb-52f1-4cc3-a1a7-88a6ae382ca5home%20page%20banner%20new.png',
        'name' => 'Fashion'
      ])
      @endcomponent

      @include('themes.' . $theme . '.partials.breadcrumb')
    
      <div class="row">
        <aside class="col-lg-3 filters-container">
          @include('themes.' . $theme . '.partials.filters')
        </aside>

        <div class="col-lg-9">
          <div class="shop-results_header">
            <div class="shop-results_count">Showing 1-15 of {{ $data['count'] }} results</div>
            @select([ 'name' => 'sort', 'id' => 'sort' ])
              <option value="1" selected>Najnovije</option>
              <option value="2">Cena rastuce</option>
              <option value="3">Cena opadajuce</option>
            @endselect
          </div>

          @component('themes.' . $theme . '.components.shop.grid', [
            'component' => 'shop.item',
            'items' => $products,
            'options' => (object)[ 'shop' => true ]
          ])
          @endcomponent
        </div>
        
      </div>

      <nav aria-label="Shop navigation">
        {{ $products->links() }}
      </nav>

    </div>

  </section>

@endsection