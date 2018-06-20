<footer id="footer">
    <div class="container footer">
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
                        <div class="logo-container logo-container--footer">
                            <svg class="logo" role="presentation">
                                <use xlink:href="#logo">
                            </svg>
                        </div>
                        <div class="newsletter-icon-wrap">
                            <svg class="icon newsletter-icon">
                                <use xlink:href="#icon_mail">
                            </svg>
                        </div>
                        <form method="POST"
                              action="{{ action('SubscribersController@subscribe') }}">
                            @csrf
                            <div class="footer_newsletter-gender">
                                @radio([
                                  'id' => 'gender-1',
                                  'name' => 'gender',
                                  'value' => 0,
                                  'checked' => true,
                                  'label' => 'Žensko',
                                  'inverse' => true,
                                ])
                                @endradio
                                @radio([
                                  'id' => 'gender-2',
                                  'name' => 'gender',
                                  'value' => 1,
                                  'label' => 'Muško',
                                  'inverse' => true,
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
<div class="subfooter">
    <div class="container subfooter_copy">
        <span>Copyright &copy; {{ date("Y") }} Luxury 4 Me | All rights reserved.</span>
        <span>Developed by <a href="https://ministudio.rs/" target="_blank" rel="noopener noreferrer">Mini STUDIO Publishing Group</a></span>
    </div>
</div>
