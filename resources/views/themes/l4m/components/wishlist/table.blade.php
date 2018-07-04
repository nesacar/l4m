<div class="checkout-table-wrap">
  <table class="checkout-table">
    <thead>
      <tr class="checkout-table_header">
        <th></th>
        <th>Naziv</th>
        <th>Cena</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < 4; $i++)
      @wishlistitem()
      @endwishlistitem
      @endfor
    </tbody>
  </table>
</div>
