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
        'text' => 'Adresa slanja',
        'disabled' => false,
      ],
      (object)[
        'link' => '#second',
        'text' => 'Način dostave',
        'disabled' => false,
      ],
      (object)[
        'link' => '#second',
        'text' => 'Način plaćanja',
        'disabled' => true,
      ],
      (object)[
        'link' => '#second',
        'text' => 'Potvrda porudžbine',
        'disabled' => true,
      ],
      (object)[
        'link' => '#second',
        'text' => 'Kraj',
        'disabled' => true,
      ],
    ],
  ])
  @endstepper
</div>
@endsection