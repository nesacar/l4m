@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="padding-top: 32px;">
  @textfield([
    'id' => 'email',
    'name' => 'email',
    'label' => 'email',
    'helper_text' => 'This field is required.',
  ])
  @endtextfield
</div>

@endsection