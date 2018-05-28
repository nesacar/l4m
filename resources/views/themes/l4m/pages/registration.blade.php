@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="padding-top: 32px;">
  @textfield()
  @endtextfield
</div>

@endsection