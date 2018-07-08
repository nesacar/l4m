<tr class="checkout-table_row">
    <td style="min-width: 72px;">
        <div class="image image--square lazy-image"
             data-src="{{ url(\Imagecache::get($product->image, '90x120')->src) }}"></div>
    </td>
    <td>
        <div class="shop-item_name">{{ $product->title }}</div>
        <div class="shop-item_brand">{{ $product->brand->title }}</div>
    </td>
    <td>@currency(['price' => $product->price]) @endcurrency</td>
    <td>
        <a class="btn btn--primary" href="{{ $product->getLink() }}">kupi</a>
    </td>
    <td>
        <button class="icon-btn">&times;</button>
    </td>
</tr>
