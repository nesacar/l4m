@php
  $isActive = isset($active) ? $active : false;
@endphp
@stepper([
  'steps' => [
    (object)[
      'link' => '/user/profile',
      'text' => 'Moj Profil',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_user"></svg>',
      'active' => $isActive == 'profile',
    ],
    (object)[
      'link' => '/user/orders',
      'text' => 'Moje porudzbine',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_list"></svg>',
      'active' => $isActive == 'orders',
    ],
    (object)[
      'link' => '/user/wishlist',
      'text' => 'Wishlist',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_star-border"></svg>',
      'active' => $isActive == 'wishlist',
    ],
    (object)[
      'link' => '/user/cart',
      'text' => 'Korpa',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_cart"></svg>',
      'active' => $isActive == 'cart',
    ],
    (object)[
      'link' => '/user/logout',
      'text' => 'Logout',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_logout"></svg>',
    ],
  ],
])
@endstepper
