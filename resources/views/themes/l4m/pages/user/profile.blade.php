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
        <div>
          @textfield([
            'value' => 'User name',
            'id' => 'name',
            'name' => 'name',
            'label' => 'Ime i prezime',
          ])
          @endtextfield
          @textfield([
            'value' => '(+381)60123456',
            'id' => 'tel',
            'name' => 'tel',
            'label' => 'Telefon',
          ])
          @endtextfield
          @textfield([
            'value' => 'User address',
            'id' => 'address',
            'name' => 'address',
            'label' => 'Ulica i broj',
          ])
          @endtextfield
          @textfield([
            'value' => 'City',
            'id' => 'city',
            'name' => 'town',
            'label' => 'Grad',
          ])
          @endtextfield
          @textfield([
            'value' => 11000,
            'id' => 'postcode',
            'name' => 'postcode',
            'label' => 'Poštanski broj',
          ])
          @endtextfield
          @selectbox([
            'id' => 'Država',
            'name' => 'country',
            'label' => 'Država',
          ])
          <option value="1">Srbija</option>
          <option value="2">Hrvatska</option>
          @endselectbox
          <div>
            <button class="btn btn--primary">izmeni</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection