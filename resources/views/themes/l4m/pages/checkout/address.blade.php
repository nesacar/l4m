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
                      'link' => '/placanje/adresa-slanja',
                      'text' => 'Adresa slanja',
                      'disabled' => false,
                    ],
                    (object)[
                      'link' => '/placanje/nacin-slanja',
                      'text' => 'Način slanja',
                      'disabled' => true,
                    ],
                    (object)[
                      'link' => '/placanje/nacim-placanja',
                      'text' => 'Način plaćanja',
                      'disabled' => true,
                    ],
                    (object)[
                      'link' => '/placanje/potvrda-porudzbine',
                      'text' => 'Potvrda porudžbine',
                      'disabled' => true,
                    ],
                    (object)[
                      'link' => '/placanje/kraj',
                      'text' => 'Kraj',
                      'disabled' => true,
                    ],
                  ],
                ])
                @endstepper
            </div>
            <div class="checkout-content my-4">
                <section class="mb-4">
                    <div class="border border--primary checkout-box text--body2">
                        <label class="checkout-box_label">Potvrdite Vašu email adresu.</label>
                        <p>Vaša adresa nije potvrđena.</p>
                        <p>Da biste mogli u potpunosti da iskoristite sve pogodnosti koje Vam naš sajt pruža potrebno je
                            da potvrdite email adresu koju ste uneli prilikom registracije.</p>
                        <p>Sve što je potrebno da uradite jeste da kliknete na link koji smo Vam poslali u poruci
                            neposredno nakon registracije.</p>
                        <p>Ukoliko ste zagubili email poruku sa linkom za potvrdu kliknite na dugme "Pošalji poruku" i
                            posaćemo Vam novi mail sa instrukcijama za aktiviranje Vašeg naloga.</p>
                        <button class="btn btn--primary">Pošalji poruku</button>
                    </div>
                </section>
                <section class="mb-4">
                    <h2 class="subtitle subtitle--sans-serif display-4">adresa slanja</h2>
                    @if(count($customer->address)== 0)
                        <p>Nemate sačuvanu adresu. Molimo Vas da unesete novu.</p>
                    @else
                        <p>Odaberite adresu na koju želite da isporučimo Vašu porudžbenicu ili unesite novu adresu
                            isporuke.</p>

                        <form method="POST" id="address-form" action="{{ url('checkout.step1') }}">
                            @csrf
                            @foreach($customer->address as $address)
                                @address([
                                  'id' => $address->id,
                                  'name' => $address->name,
                                  'telephone' => $address->phone,
                                  'street' => $address->address,
                                  'city' => $address->town,
                                  'country' => $address->country == 1? 'Srbija' : 'Hrvatska',
                                ])
                                @endaddress
                            @endforeach
                        </form>
                    @endif
                </section>
                <section class="mb-4">
                    <form action="{{ route('create.address') }}" method="POST">
                        @csrf
                        <h2 class="subtitle subtitle--sans-serif display-4">nova adresa</h2>
                        <div class="row">
                            <div class="col-md-6">
                                @textfield([
                                  'value' => old('name'),
                                  'id' => 'name',
                                  'name' => 'name',
                                  'label' => 'Ime i prezime',
                                  'required' => true,
                                  'error_message' => $errors->has('name')? $errors->first('name'): '',
                                ])
                                @endtextfield
                            </div>
                            <div class="col-md-6">
                                @textfield([
                                  'value' => old('phone'),
                                  'id' => 'tel',
                                  'name' => 'phone',
                                  'label' => 'Telefon',
                                  'required' => true,
                                  'error_message' => $errors->has('phone')? $errors->first('phone'): '',
                                ])
                                @endtextfield
                            </div>
                            <div class="col-md-6">
                                @textfield([
                                  'value' => old('address'),
                                  'id' => 'address',
                                  'name' => 'address',
                                  'label' => 'Ulica i broj',
                                  'required' => true,
                                  'error_message' => $errors->has('address')? $errors->first('address'): '',
                                ])
                                @endtextfield
                            </div>
                            <div class="col-md-6">
                                @textfield([
                                  'value' => old('city'),
                                  'id' => 'city',
                                  'name' => 'town',
                                  'label' => 'Grad',
                                  'required' => true,
                                  'error_message' => $errors->has('town')? $errors->first('town'): '',
                                ])
                                @endtextfield
                            </div>
                            <div class="col-md-6">
                                @selectbox([
                                  'id' => 'Država',
                                  'name' => 'country',
                                  'label' => 'Država',
                                  'required' => true,
                                  'error_message' => $errors->has('country')? $errors->first('country'): ''
                                ])
                                <option value="1">Srbija</option>
                                <option value="2">Hrvatska</option>
                                @endselectbox
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--primary">sačuvaj</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
  (function() {
    var form = document.getElementById('address-form');
    form.onchange = function() {
      form.submit();
    }
  }());
</script>
@endsection