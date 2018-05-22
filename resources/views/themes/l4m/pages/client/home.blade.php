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
  
  @endsection