@extends('themes.'.$theme.'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

@include('themes.'.$theme.'.pages.client.hero')

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

{{-- Ponavljati N puta --}}
<div class="container client_products client_products--border">
  <h2 class="display-3 section-title--serif">Akcija</h2>
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
{{-- /Ponavljati N puta --}}

<div class="home_discover-more">
  <div class="container">
    <h2 class="display-3 home_discover-more_title">Otrki više</h2>
    {{-- @component('themes.' . $theme . '.components.grid', [
      'component' => 'blog.tile',
      'items' => $posts,
    ])
    @endcomponent --}}
  </div>
</div>
  
@endsection