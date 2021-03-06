@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    <section class="container">
        <h1 class="section-title with-lines">
            <span>{{ $category->title }}</span>
        </h1>

        <div class="split-view">
            <div class="split-view_left-pane">
                <div class="featured-tile">
                    @component('themes.' . $theme . '.components.blog.tile', [
                      'item' => $posts->first(),
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
                    'link' => true,
                  ],
                  'items' => $posts->slice(1),
                ])
                @endcomponent

                <nav class="pagination-container" aria-label="blog navigation">
                    {{ $posts->links() }}
                </nav>
            </div>

            <aside class="split-view_right-pane">
                @if(false)
                    <div class="with-border" style="width: 100%; padding-bottom: 32px; text-align: center;">
                        <h4 class="side-content-title">istaknuti proizvodi</h4>
                        <div class="products-featured">
                            @component('themes.' . $theme . '.components.list', [
                              'component' => 'shop.item',
                              'options' => (object)[
                                'horizontal' => true,
                            ],
                            'items' => [],
                            ])
                            @endcomponent
                        </div>
                        <a href="/shop/{{ $category->title }}" class="btn btn--outline btn--block no-link"
                           style="max-width: 256px;">posetite prodavnicu</a>
                    </div>
                @endif
                @include('themes.' . $theme . '.partials.newsletter')
                <div class="social-container">
                    @social()
                </div>
                <div>
                    <h4 class="side-content-title">najčitaniji</h4>
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
