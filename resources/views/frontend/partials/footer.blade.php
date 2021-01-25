<footer id="colophon" class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="newsletter">
                <h3>Newsletter</h3>
                <form method="post" class="form-newsletter">
                    <input type="email" name="EMAIL" placeholder="Enter your Email" required>
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="widget-text">
                        <div class="footer-location">
                            <img src="images/logo1-footer.png" alt="">
                            <p>{{ $footersettings[0]['about'] }}</p>
                            <ul class="info">
                                <li><i class="ion-ios-location"></i> <span>{{ $footersettings[0]['address'] }}</span></li>
                                <li><i class="ion-ios-telephone"></i><a href="tel:8812345678">{{ $footersettings[0]['phone'] }}</a></li>
                                <li><i class="ion-email"></i><a href="mailto:contact@thimpress.com">{{ $footersettings[0]['email'] }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="widget-menu">
                        <h3 class="widget-title">Menu</h3>
                        <ul class="menu">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('rooms') }}">Rooms</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            {{-- <li><a href="#">Gallery</a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="widget-menu">
                        <h3 class="widget-title">Connect Us</h3>
                        <ul class="list-social">
                            <li><a class="facebook" href="{{ $footersettings[0]['facebook'] }}">Facebook</a></li>
                            <li><a class="twitter" href="{{ $footersettings[0]['twitter'] }}">Twitter</a></li>
                            <li><a class="instagram" href="{{ $footersettings[0]['linkedin'] }}">Instagram</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="copyright-content col-sm-12">
                    <p class="copyright-text">© 2020 <a href="#">{{ $footersettings[0]['footer'] }}</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
