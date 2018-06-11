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
              'link' => '/checkout/address',
              'text' => 'Adresa slanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/shipping',
              'text' => 'Način slanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/payment',
              'text' => 'Način plaćanja',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/confirmation',
              'text' => 'Potvrda porudžbine',
              'disabled' => false,
            ],
            (object)[
              'link' => '/checkout/checkout',
              'text' => 'Kraj',
              'disabled' => true,
            ],
          ],
        ])
        @endstepper
      </div>
      <div class="checkout-content" style="margin-top: 32px;">
        <section>
          <h2 class="subtitle subtitle--sans-serif display-4">Potvrdite narudžbinu</h2>
          <p>Pažljivo pročitajte podatke o Vašoj porudžbini i ukoliko je sve uredu kliknite na dugme "Poruči".</p>
          <p>Poručujući robu izražavate saglasnost sa <a href="#terms-and-privacy" style="text-decoration: underline;">Uslovima online poslovanja i Politikom privatnosti</a></p>
        </section>

        <section class="checkout-details">
          <div class="checkout-detail">
            <div class="checkout-detail_header">
              <h4 class="text--bold text--sans-serif display-5 no-margin">Adresa isporuke</h4>
            </div>
            <div class="checkout-detail_body">
              <p class="chekcout-detail_line no-margin">Petar Petrovic</p>
              <p class="chekcout-detail_line no-margin">+381123456789</p>
              <p class="chekcout-detail_line no-margin">Kralja Petra 4</p>
              <p class="chekcout-detail_line no-margin">11000 Beograd</p>
              <p class="chekcout-detail_line no-margin">Srbija</p>
            </div>
          </div>
          <div class="checkout-detail">
            <div class="checkout-detail_header">
              <h4 class="text--bold text--sans-serif display-5 no-margin">Način dostave</h4>
            </div>
            <div class="checkout-detail_body">
              <p class="chekcout-detail_line no-margin">DHL</p>
            </div>
          </div>
          <div class="checkout-detail">
            <div class="checkout-detail_header">
              <h4 class="text--bold text--sans-serif display-5 no-margin">Način plaćanja</h4>
            </div>
            <div class="checkout-detail_body">
              <p class="chekcout-detail_line no-margin">Pouzećem</p>
            </div>
          </div>
          <div class="checkout-detail">
            <div class="checkout-detail_header">
              <h4 class="text--bold text--sans-serif display-5 no-margin">Sadržaj korpe</h4>
            </div>
            <div class="checkout-table-wrap">
              <table class="checkout-table">
                <tr class="checkout-table_header">
                  <th>Naziv</th>
                  <th>Cena</th>
                  <th>Kol.</th>
                  <th>Ukupno</th>
                </tr>
                <tr class="checkout-table_row">
                  <td valign="top">
                    <div class="shop-item_name">Alfreds Futterkiste</div>
                    <div class="shop-item_brand">suknja</div>
                  </td>
                  <td valign="top">3214.00</td>
                  <td valign="top">2</td>
                  <td valign="top">6428.00</td>
                </tr>
                <tr class="checkout-table_row">
                  <td valign="top">
                    <div class="shop-item_name">Alfreds Futterkiste</div>
                    <div class="shop-item_brand">suknja</div>
                  </td>
                  <td valign="top">3214.00</td>
                  <td valign="top">2</td>
                  <td valign="top">6428.00</td>
                </tr>
              </table>
            </div>
          </div>
        </section>
        <a class="btn btn--primary"
          href="/checkout/checkout"
        >poruči</a>
      </div>
    </div>
  </div>
@endsection
