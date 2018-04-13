@extends('themes.l4m.index')
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
      <div class="grid">
        <div class="grid_item demo">
          <div class="image image--standard demo-img"></div>
          grid item
        </div>
        <div class="grid_item demo">
          <div class="image image--standard demo-img"></div>
          grid item
        </div>
        <div class="grid_item demo">
          <div class="image image--standard demo-img"></div>
          grid item
        </div>
      </div>
      <aside class="banner" id="banner">banner positions</aside>
    </div>
  </section>

  <section class="container">
    <h1 class="section-title"><span>section title</span></h1>
  </section>
@endsection