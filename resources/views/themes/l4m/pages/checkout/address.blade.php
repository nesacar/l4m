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
    <div class="checkout-content" style="margin-top: 32px;">
      <section>
        <div class="border border--primary checkout-box text--body2">
          <label class="checkout-box_label">Potvrdite Vašu email adresu.</label>
          <p>Vaša adresa nije potvrđena.</p>
          <p>Da biste mogli u potpunosti da iskoristite sve pogodnosti koje Vam naš sajt pruža potrebno je da potvrdite email adresu koju ste uneli prilikom registracije.</p>
          <p>Sve što je potrebno da uradite jeste da kliknete na link koji smo Vam poslali u poruci neposredno nakon registracije.</p>
          <p>Ukoliko ste zagubili email poruku sa linkom za potvrdu kliknite na dugme "Pošalji poruku" i posaćemo Vam novi mail sa instrukcijama za aktiviranje Vašeg naloga.</p>
          <button class="btn btn--primary">Pošalji poruku</button>
        </div>
      </section>
      <section>
        <h2 class="subtitle subtitle--sans-serif display-4">adresa slanja</h2>
        <p>Nemate sačuvanu adresu. Molimo Vas da unesete novu.</p>
      </section>
      <section>
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
        <div>
          <button class="btn btn--primary">sačuvaj</button>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection