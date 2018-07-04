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
      'link' => '/user/password',
      'text' => 'Zamena lozinke',
      'disabled' => false,
      'icon' => 'P'
    ],
  ],
])
@endstepper
