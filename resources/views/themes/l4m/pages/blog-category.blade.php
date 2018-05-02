@extends('themes.' . $theme . '.index')

@section('title')
Luxury 4 Me - {{ $category->title}} Blog
@endsection

@section('content')
  <section class="container">
    <h1 class="section-title with-lines">
      <span>{{ $category->title }}</span>
    </h1>

    <div class="split-view">
      <div class="split-view_left-pane">
        left pane
        {{-- @component('themes.' . $theme . '.components.list', [
          'component' => 'blog.tile',
          'options' => (object)[
            'horizontal' => true,
            'asymmetric' => true,
          ],
          'items' => $items,
        ])
        @endcomponent --}}
      </div>
      <div class="split-view_right-pane">
        right pane
      </div>
    </div>
  </section>
@endsection
