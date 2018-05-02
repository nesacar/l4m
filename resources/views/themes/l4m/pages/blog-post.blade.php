@extends('themes.' . $theme . '.index')

@section('title') Luxury 4 Me - Blog Post @endsection

@section('content')

  <section class="container" style="padding-top: 32px">
    <div class="split-view">
      <div class="split-view_left-pane">
        <article class="blog-post">
          <div class="blog-post_header">
            <small class="blog-post_date">{{ $category->title }} | May 02, 2018</small>
            <h1 class="display-2 blog-post_title">{{ $post->title }}</h1>
            <p class="blog-post_short-desc">
              <em>{{ $post->short }}</em>
            </p>
          </div>
          <div class="blog-post_gallery">
            <div class="image image--standard lazy-image"
              data-src={{ url($post->image) }}
            ></div>
            {{-- thumbnails go here --}}
          </div>
          <div>{!! $post->body !!}</div>
          <ul><!-- tags go here -->
            <li>tags</li>
          </ul><!--- /tags -->
        </article>
        <div style="margin-bottom: 32px;">
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
