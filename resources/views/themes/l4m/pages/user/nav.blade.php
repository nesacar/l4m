@stepper([
  'steps' => [
    (object)[
      'link' => '/user/profile',
      'text' => 'Moj Profil',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_user"></svg>',
    ],
    (object)[
      'link' => '/user/orders',
      'text' => 'Moje porudzbine',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_list"></svg>'
    ],
    (object)[
      'link' => '/user/wishlist',
      'text' => 'Wishlist',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_star-border"></svg>'
    ],
    (object)[
      'link' => '/korpa',
      'text' => 'Korpa',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_cart"></svg>'
    ],
    (object)[
      'link' => '/user/logout',
      'text' => 'Logout',
      'disabled' => false,
      'icon' => '<svg class="icon" role="presentation"><use xlink:href="#icon_logout"></svg>'
    ],
  ],
])
@endstepper
