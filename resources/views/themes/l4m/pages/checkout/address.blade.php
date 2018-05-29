@extends('themes.'.$theme.'.index')

@section('seo')
 {!! SEOMeta::generate() !!}
 {!! OpenGraph::generate() !!}
@endsection

@section('content')
<div class="container">
  <div class="checkout">
    <div class="checkout-steps">
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
    <div class="checkout-content">
      <h2 class="subtitle subtitle--sans-serif display-4">nova adresa</h2>
      <div class="row">
        <div class="col-md-6">
          @textfield([
            'id' => 'name',
            'name' => 'ime',
            'label' => 'Ime',
            'required' => true,
            'helper_text' => 'Ovo polje je obavezno',
          ])
          @endtextfield
        </div>
        <div class="col-md-6">
          @textfield([
            'id' => 'surname',
            'name' => 'prezime',
            'label' => 'Prezime',
            'required' => true,
            'helper_text' => 'Ovo polje je obavezno',
          ])
          @endtextfield
        </div>
        <div class="col-md-6">
          @textfield([
            'id' => 'address',
            'name' => 'adresa',
            'label' => 'Ulica i broj',
            'required' => true,
            'helper_text' => 'Ovo polje je obavezno',
          ])
          @endtextfield
        </div>
        <div class="col-md-6">
          @textfield([
            'id' => 'tel',
            'name' => 'telefon',
            'label' => 'Telefon',
            'required' => true,
            'helper_text' => 'Ovo polje je obavezno',
          ])
          @endtextfield
        </div>
      </div>
    </div>
  </div>
</div>
@endsection