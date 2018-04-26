@php

  $listX = (object)[
    "Fashion" => [
      (object)[
        "name" => "Lank1",
        "brand" => "ZZEGNA",
        "price" => 500,
        "img" => "http://www.movem.rs/images/products/VP084-ZZ960-B09-1-image(168x224-crop).jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Laston",
        "brand" => "Hugo",
        "price" => 595,
        "img" => "http://www.movem.rs/images/products/50378096-001-1-image(168x224-crop).jpg",
        "href" => "#",
        "discount" => 25
      ],
      (object)[
        "name" => "Graven",
        "brand" => "Hugo",
        "price" => 500,
        "img" => "http://www.movem.rs/images/products/50378166-001-1-image(168x224-crop).jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "T-Carano",
        "brand" => "BOSS",
        "price" => 595,
        "img" => "http://www.movem.rs/images/products/50374198-202-1-image(168x224-crop).jpg",
        "href" => "#"
      ]
    ],
    "Watches & Jewellery" => [
      (object)[
      "name" => "Carrera",
      "brand" => "TAG Heuer",
      "price" => 500,
      "img" => "http://www.s-l.co.rs/images/products/thumbnails/carrera-1459.jpg",
      "href" => "#",
      "discount" => 10
      ],
      (object)[
        "name" => "Carrera",
        "brand" => "TAG Heuer",
        "price" => 595,
        "img" => "http://www.s-l.co.rs/images/products/thumbnails/carrera-1458.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Carrera",
        "brand" => "TAG Heuer",
        "price" => 500,
        "img" => "http://www.s-l.co.rs/images/products/thumbnails/carrera-1457.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Carrera",
        "brand" => "TAG Heuer",
        "price" => 595,
        "img" => "http://www.s-l.co.rs/images/products/thumbnails/carrera-1456.jpg",
        "href" => "#"
      ]
    ],
    "Home & Interior" => [
      (object)[
        "name" => "Armchair San Diego Rose",
        "brand" => "KARE",
        "price" => 500,
        "img" => "https://pictures.kare-design.com/8/KARE-83143-250x250.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Chair Aristo",
        "brand" => "KARE",
        "price" => 595,
        "img" => "https://pictures.kare-design.com/8/KARE-83090-250x250.jpg",
        "href" => "#",
        "discount" => 25
      ],
      (object)[
        "name" => "Swivel Chair Lounge Leaf Grey",
        "brand" => "KARE",
        "price" => 500,
        "img" => "https://pictures.kare-design.com/8/KARE-83292-250x250.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Relax Chair Silence Velvet Rose",
        "brand" => "KARE",
        "price" => 595,
        "img" => "https://pictures.kare-design.com/8/KARE-82772-250x250.jpg",
        "href" => "#"
      ]
    ],
    "Fine Dining" => [
      (object)[
        "name" => "Branco",
        "brand" => "Adega de Pegoes",
        "price" => 500,
        "img" => "http://media1.izaberivino.com/2014/11/adega_de_pegoes_branco-190x243.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Cabernet Sauvignon",
        "brand" => "Adega de Pegoes",
        "price" => 595,
        "img" => "http://media1.izaberivino.com/2014/11/adega_de_pegoes_cabernet_sauvignon-190x243.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Rose",
        "brand" => "Adega de Pegoes",
        "price" => 500,
        "img" => "http://media1.izaberivino.com/2014/07/adega_de_pegoes_rose-190x243.jpg",
        "href" => "#"
      ],
      (object)[
        "name" => "Regent",
        "brand" => "Aleksandrovic",
        "price" => 595,
        "img" => "http://media1.izaberivino.com/2014/11/regent_reserve-190x243.jpg",
        "href" => "#"
      ]
    ]
  ];

  $id = $options->id;

@endphp

<div style="text-align: center;">
  @foreach($list as $index => $items)
    <input class="tab_control" type="radio" name="{{ $id }}" id="{{ $id . '-tab-' . $index }}" @if($loop->first) checked @endif>
    <label class="tab_label" for="{{ $id . '-tab-' . $index }}">{{ $items->title }}</label>
  @endforeach

  @foreach($list as $index => $items)
  <div class="tab_content" id={{ $id . '-content-' . $index }}>
    @component('themes.' . env('THEME_NAME', '') . '.components.shop.grid', [
      'component' => 'shop.item',
      'items' => $items->products4,
      'options' => isset($options) ? $options : null,
    ])
    @endcomponent
  </div>
  @endforeach
</div>