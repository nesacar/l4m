@extends('themes.'.$theme.'.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    @include('themes.'.$theme.'.pages.client.hero')

    <div class="container">
        <h2 class="display-3 home_discover-more_title">Blog</h2>
        @component('themes.' . $theme . '.components.list', [
          'component' => 'blog.tile',
          'options' => (object)[
            'horizontal' => true,
            'asymmetric' => true
          ],
          'items' => $posts,
        ])
        @endcomponent
    </div>
@endsection