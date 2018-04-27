@extends('themes.' . env('THEME_NAME', '') . '.index')

@section('title'){{ $title }}@endsection

@section('content')
  <section class="container">
    product page
  </section>
@endsection