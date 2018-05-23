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

  <section class="brands_all">
    <div class="container">
      <ul class="home_brands-list">
        <li class="home_brands-list-item">
          <a href="#">
            <img
              src="http://l4m.mia.rs/storage/uploads/brands/05-2018/boss-6-Er.png" 
              alt="brend!">
          </a>
        </li>
        <li class="home_brands-list-item">
          <a href="#">
            <img
              src="http://l4m.mia.rs/storage/uploads/brands/05-2018/hermes-13-FQ.png" 
              alt="brend!!! yeah!">
          </a>
        </li>
      </div>
    </div>
  </section>
@endsection