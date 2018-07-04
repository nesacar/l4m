@extends('themes.' . $theme . '.index')

@php
  $src = "http://l4m.mia.rs/storage/imagecache/215x287/storage/uploads/galleries/aisha-386/aisha-386-iz7L.jpg";
@endphp

@section('content')
  <div class="container">
    <div class="checkout">
      <div class="checkout-steps">
        @include('themes.'.$theme.'.pages.user.nav')
      </div>
      <div class="checkout-content mb-4 py-1">
        <h3 class="display-4 text--uppercase text--sans-serif">wishlist</h3>
        <div class="checkout-table-wrap">
          <table class="checkout-table">
            <tr class="checkout-table_header">
              <th></th>
              <th>Naziv</th>
              <th>Cena</th>
              <th></th>
              <th></th>
            </tr>

            <tr class="checkout-table_row">
              <td style="min-width: 72px;">
                <div class="image image--square lazy-image"
                  data-src={{$src}}
                ></div>
              </td>
              <td>
                <div class="shop-item_name">Product name</div>
                <div class="shop-item_brand">Product brand</div>
              </td>
              <td>12.345,00</td>
              <td>
                <a href="#product-link" class="btn btn--primary">kupi</a>
              </td>
              <td>
                <button class="icon-btn">&times;</button>
              </td>
            </tr>
            
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
