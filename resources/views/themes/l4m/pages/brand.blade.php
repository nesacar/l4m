@extends('themes.' . $theme . '.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')
    <section class="container">
        @include('themes.'.$theme.'.partials.breadcrumb')

        <div class="brand_header">
            <h1 class="display-3 brand_name">{{ $brand->title }}</h1>
            <div class="brand_about js-collapse-container">
              <div class="brand_about-content js-collapse-content">
                {!! $brand->body !!}
              </div>
            </div>
            <div style="text-align: center; padding: 8px 0;">
              <button class="icon-btn brand_about-toggle js-collapse-toggle" data-expanded="false">
                <svg class="icon">
                  <use xlink:href="#icon_arrow">
                </svg>
              </button>
            </div>
        </div>

    </section>

    @if(count($brand->slider)>0)
    <div class="brand_masthead container">
        @component('themes.'.$theme.'.components.masthead-carousel', [
          'data' => $brand->slider,
          'options' => (object)[
            'content' => false,
          ],
        ])
        @endcomponent
    </div>
    @endif

    @if(!empty($brand->links))
    <div class="container">
        <ol class="brand_tabs">
            @foreach($brand->links as $link)
            <li class="brand_tab">
                <a class="brand_link {{ \App\Helper::activeLinkWithParams($link->link)? 'active' : '' }}" href="{{ url($link->link) }}">{{ $link->title }}</a>
            </li>
            @endforeach
        </ol>
    </div>
    @endif

    <div class="container">
        @component('themes.'.$theme.'.components.shop.grid', [
          'component' => 'shop.item',
          'items' => $products,
        ])
        @endcomponent
    </div>

    <div class="container">
        <nav class="pagination-container" aria-label="shop navigation">
            {{ $products->appends(Request::all())->links() }}
        </nav>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('themes/' . $theme . '/js/brand.js') }}"></script>
@endsection
