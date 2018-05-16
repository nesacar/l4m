@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')
  <section class="container">
    @include('themes.'.$theme.'.partials.breadcrumb')

    <div class="brand_header">
      <h1 class="display-3 brand_name">Brand Name</h1>
      <p class="brand_about">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni autem sapiente soluta illo, ipsa facere quod itaque quae voluptatum repudiandae culpa eveniet minima quas quidem iste necessitatibus at ut optio!</p>
   </div>

 </section>

 {{-- Masthead --}}
  <div class="brand_masthead container">
    @component('themes.'.$theme.'.components.masthead-carousel', [
      'data' => [
        (object)[
          'slider' => '/storage/uploads/posts/05-2018/10-najskupljih-vina-na-svetu-slider--Hw-22.jpeg',
        ]
      ],
      'options' => (object)[
        'content' => false,
      ],
    ])
    @endcomponent
  </div>

  {{-- Tabs --}}
  <div class="container">
    <ol class="brand_tabs">
      <li class="brand_tab">
        <a class="brand_link" href="#">tab</a>
      </li>
      <li class="brand_tab">
        <a class="brand_link" href="#">tab</a>
      </li>
      <li class="brand_tab">
        <a class="brand_link" href="#">tab</a>
      </li>
      <li class="brand_tab">
        <a class="brand_link" href="#">tab</a>
      </li>
    </ol>
  </div>

{{-- Products --}}
  {{-- <div>
    @component('themes.'.$theme.'.components.shop.grid', [
      'component' => 'shop.item',
      'items' => 'PRODUCTS GO HERE :)',
    ])
    @endcomponent
  </div> --}}
@endsection
