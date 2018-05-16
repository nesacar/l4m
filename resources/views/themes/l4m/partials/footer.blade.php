<footer id="footer">
  <div class="container footer">
    <div class="footer_content">
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
            <p>Receive the latest news vis email</p>
            <form class="footer_newsletter" method="POST" action="{{ action('SubscribersController@subscribe') }}">
              @csrf
              <input type="text" name="email" id="nl-email" placeholder="Enter your email" aria-label="email address" />
              <button class="with-flare" aria-label="subscribe to newsletter" type="submit">
                <span role="presentation" class="arrow arrow--right"></span>
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 footer_column">
          <h4 class="section-title footer_section-title">korisnički servis</h4>
          <div class="footer_nav">
            <div class="footer_nav-item"><a href="/advertising">Reklamiranje</a></div>
            <div class="footer_nav-item"><a href="/terms">Uslovi korišćenja</a></div>
            <div class="footer_nav-item"><a href="/service">Korisnički servis</a></div>
            <div class="footer_nav-item"><a href="/privacy">Privatnost</a></div>
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
    </div>
  </div>
</footer>