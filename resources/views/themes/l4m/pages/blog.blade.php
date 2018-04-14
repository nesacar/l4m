@extends('themes.' . env('THEME_NAME','') . '.index')

@section('title'){{ $title }}@endsection

@section('content')
<style>
  .grid-wrap {
    display: flex;
  }
  .banner {
    width: 300px;
    margin-left: 30px;
    flex-grow: 0;
    flex-shrink: 0;
    /* temp */
    height: 450px;
    background-color: #E0E0E0;
  }
  .demo {
    background-color: #9E9E9E;
  }
  .demo-img {
    background-color: #424242;
  }
  .hide {
    display: none;
  }
</style>
  <section class="container">
    <h1 class="section-title"><span>section title</span></h1>
    <div class="grid-wrap">

      @include('themes.' . env('THEME_NAME', '') . '.partials.grid',  ['items' => $items])

      <aside class="banner" id="banner">banner positions</aside>
    </div>
  </section>

  <section class="container">
    <h1 class="section-title"><span>section title</span></h1>
  </section>
@endsection