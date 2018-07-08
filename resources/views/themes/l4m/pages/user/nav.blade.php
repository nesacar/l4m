@php
    $isActive = isset($active) ? $active : false;
@endphp
@stepper([
  'steps' => [
    (object)[
      'link' => '/profile',
      'text' => 'Moj Profil',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_user"></svg>',
      'active' => $isActive == 'profile',
    ],
    (object)[
      'link' => '/profile/moje-porudzbine',
      'text' => 'Moje porudžbine',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_list"></svg>',
      'active' => $isActive == 'orders',
    ],
    (object)[
      'link' => '/profile/lista-zelja',
      'text' => 'Lista želja',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_star-border"></svg>',
      'active' => $isActive == 'wishlist',
    ],
    (object)[
      'link' => '/korpa',
      'text' => 'Korpa',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_cart"></svg>',
      'active' => $isActive == 'cart',
    ],
    (object)[
      'link' => '/odjava',
      'text' => 'Odjava',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_logout"></svg>',
    ],
  ],
])
@endstepper
