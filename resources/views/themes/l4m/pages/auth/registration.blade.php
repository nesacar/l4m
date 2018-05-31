@extends('themes.' . $theme . '.index')

@section('seo')
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
@endsection

@section('content')

<div class="container" style="margin-bottom: 32px;">
  <h2 class="section-title with-lines">
    <span>Registracija</span>
  </h2>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'name',
          'name' => 'name',
          'label' => 'Ime i prezime',
          'required' => true,
          'error_message' => $errors->first('name'),
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
          'required' => true,
          'error_message' => $errors->first('email'),
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
          'required' => true,
          'error_message' => $errors->first('password'),
          ])
        @endtextfield
      </div>
      <div class="col-md-6">
        @textfield([
          'value' => '',
          'id' => 'password_confirm',
          'name' => 'password_confirmation',
          'label' => 'Potvrdite šifru',
          'type' => 'password',
          'required' => true,
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