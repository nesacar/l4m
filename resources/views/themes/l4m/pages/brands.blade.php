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
      <div class="brand_about js-collapse-container">
        <div class="brand_about-content js-collapse-content">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ex voluptatem perspiciatis porro veritatis impedit tempore cumque, unde suscipit voluptatum vel officiis explicabo provident eaque in voluptate modi! Facere, perspiciatis architecto!
        </div>
      </div>
      <div style="text-align: center; padding: 8px 0;">
        <button class="icon-btn brand_about-toggle js-collapse-toggle" data-expanded="false">
          <svg class="icon">
            <use xlink:href="#icon_arrow">
          </svg>
        </button>
      </div>
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