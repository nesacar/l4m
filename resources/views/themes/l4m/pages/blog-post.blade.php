@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

  <section class="container" style="padding-top: 32px">
    <div class="split-view">
      <div class="split-view_left-pane">
        <article class="blog-post">
          <div class="blog-post_header">
            <small class="blog-post_date">{{ $category->title }} | {{ \Carbon\Carbon::parse($post->publish_at)->format('F d, Y') }}</small>
            <h1 class="display-2 blog-post_title">{{ $post->title }}</h1>
            <p class="blog-post_short-desc">
              <em>{{ $post->short }}</em>
            </p>
          </div>
          @if(count($post->gallery)>0)
          <div class="blog-post_gallery">
            <div class="image image--standard lazy-image"
              data-src={{ url($post->image) }}
            ></div>
            {{-- thumbnails go here --}}
          </div>
          @endif
          <div class="blog-post_body">{!! $post->body !!}</div>
          @if(count($post->tag)>0)
          <ul class="tag-list">
            @foreach($post->tag as $tag)
              <li class="tag"><a href="{{ url('tagovi/'.$tag->slug) }}">{{ $tag->title }}</a></li>
            @endforeach
          </ul><!--- /tags -->
          @endif
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
            @component('themes.' . $theme . '.components.list', [
              'component' => 'shop.item',
              'options' => (object)[
                'horizontal' => true,
            ],
            'items' => $products,
            ])
            @endcomponent
          </div>
          @if(count($products)>0)
          <a href="{{ $products->first()->category->first()->getLink() }}" class="btn btn--outline btn--block no-link" style="max-width: 256px;">poseti prodavnicu</a>
          @endif
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
