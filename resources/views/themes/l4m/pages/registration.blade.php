@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="padding-top: 32px;">
  <form>
    <div class="row">
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'name',
          'name' => 'name',
          'label' => 'Ime i prezime',
          'helper_text' => 'Ovo polje je obavezno',
          'required' => true,
          'error' => false,
          ])
        @endtextfield
      </div>
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'email',
          'name' => 'email',
          'label' => 'email',
          'type' => 'email',
          'helper_text' => 'Ovo polje je obavezno',
          'required' => true,
          'error' => false,
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
          'error' => false,
          ])
        @endtextfield
      </div>
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'password_confirm',
          'name' => 'password_confirm',
          'label' => 'Potvrdite šifru',
          'type' => 'password',
          'helper_text' => 'Ovo polje je obavezno',
          'required' => true,
          'error' => false,
          ])
        @endtextfield
      </div>
    </div>
  </form>
</div>

@endsection