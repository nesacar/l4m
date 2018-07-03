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
        <h3 class="display-4 text--sans-serif">Moje porudzbine</h3>
        <div>
          <div class="checkout-table-wrap">
            <table class="checkout-table">
              <tr class="checkout-table_header">
                <th>Naziv</th>
                <th>Cena</th>
                <th>Datum</th>
                <th>Status</th>
              </tr>
              <tr class="checkout-table_row">
                <td valign="top">
                  <div class="shop-item_name">product name</div>
                  <div class="shop-item_brand">product brand</div>
                </td>
                <td valign="top">1234,00</td>
                <td valign="top">01.11.2018.</td>
                <td valign="top">
                  <span class="badge badge--pending">u obradi</span>
                </td>
              </tr>
              <tr class="checkout-table_row">
                <td valign="top">
                  <div class="shop-item_name">product name</div>
                  <div class="shop-item_brand">product brand</div>
                </td>
                <td valign="top">1234,00</td>
                <td valign="top">01.11.2018.</td>
                <td valign="top">
                  <span class="badge badge--received">primljena</span>
                </td>
              </tr>
              <tr class="checkout-table_row">
                <td valign="top">
                  <div class="shop-item_name">product name</div>
                  <div class="shop-item_brand">product brand</div>
                </td>
                <td valign="top">1234,00</td>
                <td valign="top">01.11.2018.</td>
                <td valign="top">
                  <span class="badge badge--completed">kompletirana</span>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection