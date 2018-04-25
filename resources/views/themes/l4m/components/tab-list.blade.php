@php

function _getProducts () {
  return [
    (object)[
      "name" => "balmoral",
      "brand" => "Chesterfield",
      "price" => 500,
      "img" => "https://pictures.kare-design.com/8/KARE-83143-250x250.jpg",
      "href" => "#",
      "discount" => 10
    ],
    (object)[
      "name" => "bluza consuella",
      "brand" => "BOSS",
      "price" => 595,
      "img" => "https://pictures.kare-design.com/8/KARE-83090-250x250.jpg",
      "href" => "#"
    ],
    (object)[
      "name" => "skirt",
      "brand" => "BOSS",
      "price" => 500,
      "img" => "https://pictures.kare-design.com/8/KARE-83292-250x250.jpg",
      "href" => "#"
    ],
    (object)[
      "name" => "kaput w casilie",
      "brand" => "BOSS",
      "price" => 595,
      "img" => "https://pictures.kare-design.com/8/KARE-82772-250x250.jpg",
      "href" => "#"
    ]
  ];
}

  $list = [
    _getProducts(),
    _getProducts(),
    _getProducts(),
    _getProducts()
  ];

@endphp

<div>
  @foreach($list as $i => $items)
  <div>
    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $items
    ])
    @endcomponent
  </div>
  @endforeach
</div>