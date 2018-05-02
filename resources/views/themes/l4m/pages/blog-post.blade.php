@extends('themes.' . $theme . '.index')

@section('title') Luxury 4 Me - Blog Post @endsection

@section('content')

  <section class="container">
    <div class="split-view">
      <div class="split-view_left-pane">
        <article>
          <h1 class="display-2">{{ $post->title }}</h1>
          <em>{{ $post->short }}</em>
          <div class="image image--standard lazy-image"
            data-src={{ url($post->image) }}
          ></div>
          <div>{!! $post->body !!}</div>
        </article>
        <div>
          <h2 class="section-title with-lines"><span>you may also like</span></h2>
          @component('themes.' . $theme . '.components.grid',
            [
              'component' => 'blog.tile',
              'theme' => $theme,
              'items' => $posts->slice(0,4),
              'options' => (object)[
                'label' => false,
              ],
            ])
          @endcomponent
        </div>
      </div>
      <aside class="split-view_right-pane">
        <div class="with-border" style="width: 100%; padding-bottom: 32px; text-align: center;">
          <h4 class="side-content-title">featured products</h4>
          <div class="products-featured">
          products...
          </div>
          <a href="/shop/{{ $category->title }}" class="btn btn--outline btn--block no-link" style="max-width: 256px;">visit shop</a>
        </div>
        @include('themes.' . $theme . '.partials.newsletter')
        <div class="social-container">
          @social()
        </div>
        <div>
          <h4 class="side-content-title">most viewed posts</h4>
          @component('themes.' . $theme . '.components.list', [
            'component' => 'blog.list-item',
            'items' => $posts->slice(4),
            'theme' => $theme
            ])
          @endcomponent
        </div>
      </aside>
    </div>
  </section>

@endsection
