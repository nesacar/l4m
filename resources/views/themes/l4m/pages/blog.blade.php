@extends('themes.l4m.index')
@section('content')
<style>
  .test {
    height: 300px;
    width: 100%;
    background-color: aqua;
  }
  .banner {
    height: 300px;
    background-color: chocolate;
  }
  .hide {
    display: none;
  }
</style>
  <div class="container">
    <h1 class="section-title"><span>section title</span></h1>
    <div class="grid">
      <div class="row">
        <div class="column">
          <div class="test">column</div>
        </div>
        <div class="column">
          <div class="test">column</div>
        </div>
        <div class="column">
          <div class="test">column</div>
        </div>
      </div>
      <div class="row" id="banner">
        <div class="column">
          <div class="banner">banner</div>
        </div>
      </div>
    </div>
  </div>
@endsection