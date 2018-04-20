@php

  $categories = [
    (object)[ 'href' => 'fashion', 'text' => 'fashion', 'img' => 'https://www.luxlife.rs/chest/timg/1523975003_nike-air-jordan-1-louis-vuitton-1-963x580.jpg' ],
    (object)[ 'href' => 'jewelery', 'text' => 'watches & jewellery', 'img' => 'https://www.luxlife.rs/image.php/15.jpg?width=600&image=https://www.luxlife.rs/chest/gallery/15-najskupljih-rolex-modela/15.jpg' ],
    (object)[ 'href' => 'interior', 'text' => 'home & interior', 'img' => 'https://www.luxlife.rs/image.php/luksuz-hotel-odmor-99.jpg?width=600&image=https://www.luxlife.rs/chest/gallery/raskosno-odmaraliste-na-karibima/luksuz-hotel-odmor-99.jpg' ],
    (object)[ 'href' => 'dining', 'text' => 'fine dining', 'img' => 'https://www.luxlife.rs/chest/timg/1522240750_00.jpg' ]
  ];

@endphp
<div class="categorie">
  @foreach($categories as $i => $categorie)
    <a class="categorie_item with-flare" href="{{ $categorie->href }}">
      <div class="image categorie_image lazy-image"
        data-src="{{ $categorie->img }}"
      ></div>
      <div class="categorie_name">{{ $categorie->text }}</div>
    </a>
  @endforeach
</div>