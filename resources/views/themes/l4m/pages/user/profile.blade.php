@extends('themes.' . $theme . '.index')

@section('content')
  <div class="container">
    <h2 class="display-2 text--sans-serif">user profile</h2>
    <div class="checkout">
      <div class="checkout-steps">
        @stepper([
          'steps' => [
            (object)[
              'link' => '/profil/profile',
              'text' => 'Moj Profil',
              'disabled' => false,
            ],
            (object)[
              'link' => '/profil/Porudzbine',
              'text' => 'Moje porudzbine',
              'disabled' => false,
            ],
          ],
        ])
        @endstepper
      </div>
      <div class="checkout-content my-4">
        <h3 class="display-4 text--sans-serif">section tite</h3>
        <div>content</div>
      </div>
    </div>
  </div>
@endsection