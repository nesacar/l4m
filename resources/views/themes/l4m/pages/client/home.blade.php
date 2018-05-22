@extends('themes.'.$theme.'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="hero hero--scrim client_hero">
  <div class="image hero_image">
    <picture>
      {{-- <source
        media="(min-width: 696px)"
        srcset="https://images.pexels.com/photos/54200/pexels-photo-54200.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"> --}}
      <img
        src="https://images.pexels.com/photos/356830/pexels-photo-356830.jpeg?auto=compress&cs=tinysrgb&h=350"
      />
    </picture>
  </div>
  <div class="client_profile">
    <div class="container client_profile-wrap">
      <div class="avatar">
        <div class="image image--square">
          <img
          src="https://images.pexels.com/photos/555017/pexels-photo-555017.jpeg?auto=compress&cs=tinysrgb&h=350"
          alt="doggy">
        </div>
      </div>
      <div class="client_info">
        <h1 class="client_name">Client Name</h1>
        <nav class="client_nav">
          <ul class="client_nav-list">
            <li class="client_nav-item">
              <a href="#" class="client_nav-link">o nama</a>
            </li>
            <li class="client_nav-item">
              <a href="#" class="client_nav-link active">web shop</a>
            </li>
            <li class="client_nav-item">
              <a href="#" class="client_nav-link">akcije</a>
            </li>
            <li class="client_nav-item">
              <a href="#" class="client_nav-link">blog</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container client_products">
  <h2 class="display-3 section-title--serif">Akcija</h2>
  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

  <div class="showcase_carousel client_showcase">
    {{-- @foreach($featuredProducts->first()->product as $i => $product)
    <div class="showcase_item">
      @component('themes.' . $theme . '.components.shop.item', [
        'product' => $product,
        'theme' => $theme,
        '_index' => $i
      ])
      @endcomponent
    </div>
    @endforeach --}}
  </div>

  <a href="#" class="btn btn--primary">pogledajte sve</a>
</div>

<div class="client_brands">
  <div class="container">
    <h2 class="display-3 section-title--serif">Brendovi</h2>
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
</div>
  
@endsection