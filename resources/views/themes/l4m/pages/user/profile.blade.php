@extends('themes.' . $theme . '.index')

@section('content')
  <div class="container">
    <h2 class="display-2 text--sans-serif">Moj profil</h2>
    <div class="checkout">
      <div class="checkout-steps">
        @stepper([
          'steps' => [
            (object)[
              'link' => '/user/profile',
              'text' => 'Moj Profil',
              'disabled' => false,
              'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_user"></svg>',
            ],
            (object)[
              'link' => '/user/orders',
              'text' => 'Moje porudzbine',
              'disabled' => false,
              'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_list"></svg>'
            ],
            (object)[
              'link' => '/user/password',
              'text' => 'Zamena lozinke',
              'disabled' => false,
              'icon' => 'P'
            ],
          ],
        ])
        @endstepper
      </div>
      <div class="checkout-content my-4">
        <h3 class="display-4 text--sans-serif">Moj profil</h3>
        <form class="pb-4">
          <div class="mb-2">
            @textfield([
              'value' => 'User name',
              'id' => 'name',
              'name' => 'name',
              'label' => 'Ime i prezime',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            @endtextfield
            @textfield([
              'value' => '(+381)60123456',
              'id' => 'tel',
              'name' => 'tel',
              'label' => 'Telefon',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            @endtextfield
            @textfield([
              'value' => 'User address',
              'id' => 'address',
              'name' => 'address',
              'label' => 'Ulica i broj',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            @endtextfield
            @textfield([
              'value' => 'City',
              'id' => 'city',
              'name' => 'town',
              'label' => 'Grad',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            @endtextfield
            @textfield([
              'value' => 11000,
              'id' => 'postcode',
              'name' => 'postcode',
              'label' => 'Poštanski broj',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            @endtextfield
            @selectbox([
              'id' => 'Država',
              'name' => 'country',
              'label' => 'Država',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
            ])
            <option value="1">Srbija</option>
            <option value="2">Hrvatska</option>
            @endselectbox
          </div>
          <div>
            <button class="btn btn--primary">Promeni podatke</button>
          </div>
        </form>
        <form class="pb-4">
          <div class="mb-2">
            @textfield([
              'value' => 'stara lozinka',
              'id' => 'password',
              'name' => 'password',
              'label' => 'Lozinka',
              'type' => 'password',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
              ])
            @endtextfield
            @textfield([
              'value' => '',
              'id' => 'new_password',
              'name' => 'new_password',
              'label' => 'Nova lozinka',
              'type' => 'password',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
              ])
            @endtextfield
            @textfield([
              'value' => '',
              'id' => 'repeat_password',
              'name' => 'repeat_password',
              'label' => 'Ponovite lozinku',
              'type' => 'password',
              'helper_text' => 'Ovo polje je obavezno',
              'required' => true,
              'error' => false,
              ])
            @endtextfield
          </div>
          <div>
            <button class="btn btn--primary">Promeni lozinku</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection