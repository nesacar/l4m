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
    background-color: lightgray;
  }
  .test {
    background-color: darkgray;
    height: 320px;
  }
  .hide {
    display: none;
  }
</style>
  <div class="container">
    <h1 class="section-title"><span>section title</span></h1>
    <div class="grid-wrap">
      <div class="grid">
        <div class="grid_item test">
          grid item
        </div>
        <div class="grid_item test">
          grid item
        </div>
        <div class="grid_item test">
          grid item
        </div>
      </div>
      <div class="banner" id="banner"></div>
    </div>
  </div>
@endsection