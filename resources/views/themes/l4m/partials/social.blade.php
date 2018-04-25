@php

  $items = [
    (object)[
      'platform' => 'facebook',
      'link' => 'https://www.facebook.com',
      'label' => 'pratite nas na facebooku'
    ],
    (object)[
      'platform' => 'instagram',
      'link' => 'https://www.instagram.com/?hl=en',
      'label' => 'pratite nas na isntagramu'
    ],
    (object)[
      'platform' => 'twitter',
      'link' => 'https://twitter.com/?lang=en',
      'lable' => 'pratite nas na twitteru'
    ]
  ];

@endphp

@component('themes.'. $theme .'.components.social', [
  'items' => $items
])
@endcomponent