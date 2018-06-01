@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    <section class="container">
        @include('themes.' . $theme . '.partials.breadcrumb')

        <div class="split-view">
            <div class="split-view_left-pane">
                <article class="blog-post">
                    <div class="blog-post_header">
                        <small class="blog-post_date">{{ $category->title }}
                            | {{ \Carbon\Carbon::parse($post->publish_at)->format('F d, Y') }}</small>
                        <h1 class="display-2 blog-post_title">{{ $post->title }}</h1>
                        <p class="blog-post_short-desc">
                            <em>{{ $post->short }}</em>
                        </p>
                    </div>
                    @if(count($post->gallery)>0)
                        <div class="blog-post_gallery">
                            <div class="image image--standard">
                                <img src={{ url($post->image) }} />
                            </div>
                            {{-- thumbnails go here --}}

                            {{-- /thumbnails --}}
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
                @if(!empty($posts))
                <div style="margin-bottom: 32px;">
                    <h2 class="section-title with-lines"><span>možda Vam se svidi</span></h2>
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
                @endif
            </div>
            <aside class="split-view_right-pane">
                @if(count($post->product)>0)
                <div class="with-border" style="width: 100%; padding-bottom: 32px; text-align: center;">
                    <h4 class="side-content-title">povezani proizvodi</h4>
                    <div class="products-featured">
                        @component('themes.' . $theme . '.components.list', [
                          'component' => 'shop.item',
                          'options' => (object)[
                            'horizontal' => true,
                        ],
                        'items' => $post->product,
                        ])
                        @endcomponent
                    </div>
                    @if(count($post->product)>0)
                        <a href="{{ $post->product->first()->category->first()->getLink() }}"
                           class="btn btn--outline btn--block no-link" style="max-width: 256px;">posetite prodavnicu</a>
                    @endif
                </div>
                @endif

                @include('themes.' . $theme . '.partials.newsletter')
                <div class="social-container">
                    @social()
                </div>
                @if(!empty($mostView))
                <div>
                    <h4 class="side-content-title">najčitanije</h4>
                    @component('themes.' . $theme . '.components.list', [
                      'component' => 'blog.list-item',
                      'items' => $mostView,
                      'theme' => $theme
                      ])
                    @endcomponent
                </div>
                @endif
                <div class="expand--lg">
                    {{--<h4 class="side-content-title">categories</h4>--}}
                    <div class="categorie-banner categorie-banner--small">
                        <div class="image image--portrait invertable-image categorie-banner_image">
                            <img cross-origin="anonymous"
                                 src="https://images.unsplash.com/photo-1499028344343-cd173ffc68a9?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a963d29c6015992527cc43326e0e2197&auto=format&fit=crop&w=1350&q=80"
                                 alt="burger, mmm...">
                        </div>
                        <div class="categorie-banner_content">
                            <div class="categorie-banner_label">Fine dining</div>
                            <h3 class="display-3">A barbecue isn't complete without a proper homemade burger</h3>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>

@endsection
