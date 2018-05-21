@extends('themes.'.$theme.'.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="hero hero--scrim">
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
</div>
<div class="avatar, name, nav">
  <div class="avatar" style="width: 192px;">
    <div class="image image--square">
      <img
        src="https://images.pexels.com/photos/555017/pexels-photo-555017.jpeg?auto=compress&cs=tinysrgb&h=350"
        alt="doggy">
    </div>
  </div>
  <div class="name, nav">
    <h1>name</h1>
    <nav>
      <ul>
        <li>o nama</li>
        <li>web shop</li>
        <li>akcije</li>
        <li>blog</li>
      </ul>
    </nav>
  </div>
</div>

@endsection