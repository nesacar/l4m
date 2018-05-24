<div class="hero hero--scrim client_hero">
  <div class="image hero_image">
    <picture>
      {{-- <source
        media="(min-width: 696px)"
        srcset="https://images.pexels.com/photos/54200/pexels-photo-54200.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"> --}}
      <img src="{{ url($client->cover) }}" alt="{{ $client->name }}"/>
    </picture>
  </div>
  <div class="client_profile">
    <div class="container client_profile-wrap">
      <div class="avatar">
        <div class="image image--square" style="background: #BBB;">
          <img src="{{ url($client->image) }}" alt="{{ $client->name }}">
        </div>
      </div>
      <div class="client_info">
        <h1 class="client_name">{{ $client->name }}</h1>
        <nav class="client_nav">
          <ul class="client_nav-list">
            <li class="client_nav-item">
              <a href="{{ url($client->slug . '/o-nama') }}" class="client_nav-link {{ $template == 'about'? 'active': '' }}">o nama</a>
            </li>
            <li class="client_nav-item">
              <a href="{{ url($client->slug . '/shop') }}" class="client_nav-link {{ $template == 'shop'? 'active': '' }}">web shop</a>
            </li>
            <li class="client_nav-item">
              <a href="{{ url($client->slug . '/akcije') }}" class="client_nav-link {{ $template == 'action'? 'active': '' }}">akcije</a>
            </li>
            <li class="client_nav-item">
              <a href="{{ url($client->slug . '/blog') }}" class="client_nav-link {{ $template == 'blog'? 'active': '' }}">blog</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>