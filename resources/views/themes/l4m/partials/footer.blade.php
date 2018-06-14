<footer id="footer">
  <div class="container footer">
    {{-- <div class="footer_content">
      <div style="text-align: center;">
        <div class="logo-container">
          <svg class="logo" role="presentation">
            <use xlink:href="#logo">
          </svg>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="footer_column">
            <h4 class="section-title footer_section-title">o nama</h4>
            <p>{!! $settings->footer !!}</p>
          </div>
          <div class="footer_column">
            <h4 class="section-title footer_section-title">newsletter</h4>
            <p>Saznajte najnovije vesti putem emaila</p>
            <form class="footer_newsletter" method="POST" action="{{ action('SubscribersController@subscribe') }}">
              @csrf
              <input type="text" name="email" id="nl-email" placeholder="Unesite email adresu" aria-label="email address" />
              <button class="with-flare" aria-label="subscribe to newsletter" type="submit">
                <span role="presentation" class="arrow arrow--right"></span>
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 footer_column">
          <h4 class="section-title footer_section-title">korisnički servis</h4>
          <div class="footer_nav">
            <div class="footer_nav-item"><a href="{{ url('blog/info/reklamiranje/44') }}">Reklamiranje</a></div>
            <div class="footer_nav-item"><a href="{{ url('blog/info/uslovi-koriscenja/45') }}">Uslovi korišćenja</a></div>
            <div class="footer_nav-item"><a href="{{ url('blog/info/korisnicki-servis/46') }}">Korisnički servis</a></div>
            <div class="footer_nav-item"><a href="{{ url('blog/info/provatnost/47') }}">Privatnost</a></div>
          </div>
        </div>
        <div class="col-md-4 footer_column">
          <h4 class="section-title footer_section-title">kontakt</h4>
          <div class="contact-column">
            <div class="contact-cell">
              <div class="contact-icon">
                <svg class="icon">
                  <use xlink:href="#icon_location">
                </svg>
              </div>
              <div>{{ $settings->title }}</div>
              <div>{{ $settings->address }}</div>
            </div>
            <div class="contact-cell">
              <div class="contact-icon">
                <svg class="icon">
                  <use xlink:href="#icon_mail">
                </svg>
              </div>
              <div><a href="mailto:luxury@luxury4.me">luxury@luxury4.me</a></div>
              <div><a href="mailto:support@luxury4.me">support@luxury4.me</a></div>
            </div>
            <div class="contact-cell">
              <div class="contact-icon">
                <svg class="icon">
                  <use xlink:href="#icon_phone">
                </svg>
              </div>
              <div><a href="tel:+381111234567">(+381) 11 123 4567</a></div>
              <div><a href="tel:+381111234567">(+381) 11 123 4567</a></div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="row footer_row">
      <div class="col-lg-2 col-md-3 footer_column">
        <h4 class="section-title footer_section-title">kontakt</h4>
        <div class="footer_nav">
          <div class="footer_nav-item">
            <div><a href="tel:+381111234567">(+381) 11 123 4567</a></div>
            <div><a href="tel:+381111234567">(+381) 11 123 4567</a></div>
          </div>
          <div class="footer_nav-item">
            <div><a href="mailto:luxury@luxury4.me">luxury@luxury4.me</a></div>
            <div><a href="mailto:support@luxury4.me">support@luxury4.me</a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 footer_column">
        <h4 class="section-title footer_section-title">info</h4>
        <div class="footer_nav">
          <div class="footer_nav-item">
            <a href="#">Kako kupiti online</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Najčepća pitanja</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Načini plaćanja</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Uslovi korišćenja</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Politika privatnosti</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Rokovi isporuke</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Reklamacije</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 footer_column footer_column--first">
        <div class="footer_newsletter-wrap">
          <div class="footer_newsletter">
            <form method="POST"
              action="{{ action('SubscribersController@subscribe') }}">
              @csrf
              <div class="footer_newsletter-gender">
                @radio([
                  'id' => 'gender-1',
                  'name' => 'gender',
                  'value' => 'zene',
                  'checked' => true,
                  'label' => 'Žensko',
                ])
                @endradio
                @radio([
                  'id' => 'gender-2',
                  'name' => 'gender',
                  'value' => 'muskarci',
                  'label' => 'Muško',
                ])
                @endradio
              </div>
              <div class="footer_newsletter-form">
                <input
                  type="email"
                  name="email"
                  id="nl-email"
                  placeholder="Unesite email adresu"
                  aria-label="email address"
                />
                <button class="with-flare"
                  aria-label="subscribe to newsletter"
                  type="submit"
                ><span role="presentation" class="arrow arrow--right"></span>
                </button>
              </div>
            </form>
            <p>Prijavite se i otkrijte novosti i promocije.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 footer_column">
        <h4 class="section-title footer_section-title">for me</h4>
        <div class="footer_nav">
          <div class="footer_nav-item">
            <a href="#">Login</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">My orders</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">My details</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Wishlist</a>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 footer_column">
        <h4 class="section-title footer_section-title">o nama</h4>
        <div class="footer_nav">
          <div class="footer_nav-item">
            <a href="#">O kompaniji</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Karijera</a>
          </div>
          <div class="footer_nav-item">
            <a href="#">Postani partner</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>