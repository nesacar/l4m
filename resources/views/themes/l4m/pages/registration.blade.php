@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="padding-top: 32px;">
  <div class="text-field">
    <input class="text-field_input" type="text" name="hello" id="hello">
    <label class="text-field_label" for="hello">Hello</label>
    <div class="text-field_line"></div>
  </div>
</div>

@endsection