@extends('themes.'.$theme.'.index')

@section('seo')
 {!! SEOMeta::generate() !!}
 {!! OpenGraph::generate() !!}
@endsection

@section('content')
<div class="container">
  @stepper([
    'steps' => [
      (object)[
        'link' => '#first',
        'text' => 'First step',
        'disabled' => false,
      ],
      (object)[
        'link' => '#second',
        'text' => 'second step',
        'disabled' => true,
      ],
    ],
  ])
  @endstepper
</div>
@endsection