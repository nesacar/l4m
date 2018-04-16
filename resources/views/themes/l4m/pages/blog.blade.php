@extends('themes.' . env('THEME_NAME','') . '.index')

@section('title'){{ $title }}@endsection

@section('content')
<style>
  .grid-wrap {
    display: flex;
  }
  .banner {
    width: 300px;
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

    <div class="split-view">

      <div class="split-view_left-pane">
        @component('themes.' . env('THEME_NAME', '') . '.components.grid',
          [
            'component' => 'grid-tile',
            'items' => $items
          ]
        )
        @endcomponent
      </div>

      <aside class="split-view_right-pane" id="banner">
        <div class="banner">banner positions</div>
      </aside>

    </div>

  </section>

  <section class="container">
    <h1 class="section-title"><span>section title</span></h1>

    <div class="split-view">
      <div class="split-view_left-pane"></div>
      
      <div class="split-view_right-pane">
        @component('themes.' . env('THEME_NAME', '') . '.components.list', [
          'component' => 'blog.list-item',
          'items' => $items
          ])
        @endcomponent
      </div>
    
    </div>

  </section>
@endsection