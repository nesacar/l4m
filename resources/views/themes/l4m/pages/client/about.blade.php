@extends('themes.'.$theme.'.index')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endsection

@section('content')

    @include('themes.'.$theme.'.pages.client.hero')
    <section class="container">
        <h2 class="display-3 section-title--serif">O Nama</h2>
        <p>{!! $client->body !!}</p>
    </section>

    <section class="home_discover-more">
        <div class="container">
            <h2 class="display-3 home_discover-more_title">Otkrij više</h2>
            @component('themes.' . $theme . '.components.grid', [
             'component' => 'blog.tile',
             'items' => $posts,
           ])
            @endcomponent
        </div>
    </section>
@endsection