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
        <div style="border-bottom: 1px solid red;">
          @component('themes.' . $theme . '.components.blog.tile', [
            'item' => $posts[0],
            'options' => (object)[
              'label' => false,
              'imgRatio' => 'wide',
            ],
          ])
          @endcomponent
        </div>
        @component('themes.' . $theme . '.components.list', [
          'component' => 'blog.tile',
          'options' => (object)[
            'horizontal' => true,
            'asymmetric' => true,
            'label' => false,
          ],
          'items' => $posts,
        ])
        @endcomponent
        
      </div>
      <div class="split-view_right-pane">
        right pane
      </div>
    </div>
  </section>
@endsection
