@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="margin-bottom: 32px;">
  <h2 class="section-title with-lines">
    <span>Logovanje</span>
  </h2>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'email',
          'name' => 'email',
          'label' => 'email',
          'type' => 'email',
          'helper_text' => 'Ovo polje je obavezno',
          'required' => true,
          'error_message' => false,
          ])
        @endtextfield
      </div>
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'password',
          'name' => 'password',
          'label' => 'Šifra',
          'type' => 'password',
          'helper_text' => 'Ovo polje je obavezno',
          'required' => true,
          'error_message' => false,
          ])
        @endtextfield
      </div>
    </div>
    <div class="form_footer">
      <button class="btn btn--outline" type="reset">poništi</button>
      <button class="btn btn--primary" type="submit">potvrdi</button>
    </div>
  </form>
</div>

@endsection