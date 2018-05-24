@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
  <section class="container">
    @include('themes.'.$theme.'.partials.breadcrumb')

    <div class="brand_header">
      <h1 class="display-3 section-title--serif">Brendovi</h1>
      <p class="text--serif">Luxury4 je jedinstvena online destinacija za kupovinu najluksuznijih proizvoda – od mode i aksesoara, preko vina i delikatesa, pa sve do nameštaja rađenog po meri i nesvakidašnjih detalja. Posetite nas i zakoračite u svet ekskluzivnosti, o kom ste do sada samo maštali!</p>
    </div>

  </section>

  @if(count($brands)>0)
  <section class="brands_all">
    <div class="container">
      <ul class="home_brands-list">
        @foreach($brands as $brand)
        <li class="home_brands-list-item">
          <a href="{{ $brand->getLink() }}">
            <img src="{{ url($brand->logo) }}" alt="{{ $brand->title }}">
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
  @endif
@endsection