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
        @if(!empty($products))
            @foreach($products as $product)
                @wishlistitem(['product' => $product])@endwishlistitem
            @endforeach
        @endif
        </tbody>
    </table>
</div>
