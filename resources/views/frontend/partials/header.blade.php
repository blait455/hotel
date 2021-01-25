<header id="masthead" class="header-default affix-top sticky-header ">
    <div class="row">
        <div class="header-menu col-sm-12 tm-table">
            <div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
                <div class="icon-wrap">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div>
            </div>

            <div class="width-logo sm-logo table-cell text-center">
                <a href="index.html" class="no-sticky-logo" title="Hotel HTML Template">
                    <img class="logo" src="{{ asset('frontend/images/logo3.png') }}" alt="">
                    <img class="mobile-logo" src="{{ asset('frontend/images/logo3.png') }}" alt="">
                </a>
                <a href="index.html" class="sticky-logo">
                    <img src="{{ asset('frontend/images/logo3.png') }}" alt="">
                </a>
            </div>
            <div class="width-navigation navigation table-cell">
                <div class="top-toolbar clearfix">
                    <div class="toolbar-info pull-left col-sm-4">
                        <i class="ion-ios-telephone"></i> <span class="label">Need help? Call us now:</span>
                        <a class="value" href="tel:+{{ $settings->phone }}">&nbsp; +{{ $settings->phone }}</a>
                    </div>
                    <div class="toolbar-right pull-right col-sm-8">
                        <div class="weather">
                            Today: <img src="{{ asset('frontend/images/icons/weather.png') }}" alt="">
                            <span class="temperature">28°C</span>
                        </div>
                        {{-- <ul class="top-menu">
                            <li class="menu-item"><a href="shop.html">Our Story</a></li>
                            <li class="menu-item"><a href="blog.html">News & Awards</a></li>
                            <li class="menu-item"><a href="gallery.html">Gallery</a></li>
                        </ul> --}}
                        {{-- <div class="language">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle select" data-hover="dropdown" data-toggle="dropdown" aria-expanded="false">
                                    <i class="flag-el"></i>English<span class="fa fa-caret-down"></span>
                                </a>
                                <ul class="dropdown-language">
                                    <li><a href="#"><i class="flag-it"></i>Italiano</a></li>
                                    <li><a href="#"><i class="flag-de"></i>Deutsch</a></li>
                                    <li><a href="#"><i class="flag-fr"></i>Français</a></li>
                                    <li><a href="#"><i class="flag-es"></i>Español</a></li>
                                </ul>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <ul class="nav main-menu">
                    <li class="menu-item">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('rooms') }}">Rooms</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('blog') }}">Blog</a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="events.html">Events</a>
                    </li>
                    <li class="menu-item has-children">
                        <a href="#">Features</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="about-us.html">About Us</a></li>
                            <li class="menu-item"><a href="shop.html">Shop</a></li>
                            <li class="menu-item has-children"><a href="gallery.html">Gallery</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="gallery-2columns.html">Gallery 2 Columns</a></li>
                                    <li class="menu-item"><a href="gallery.html">Gallery 3 Columns</a></li>
                                    <li class="menu-item"><a href="gallery-full-width.html">Gallery Full Width</a></li>
                                    <li class="menu-item"><a href="gallery-without-filter.html">Gallery Without Filter</a></li>
                                    <li class="menu-item"><a href="gallery-with-content.html">Gallery With Content</a></li>

                                </ul>
                            </li>
                            <li class="menu-item"><a target="_blank" href="were-launching-soon.html">Coming Soon Page</a></li>
                            <li class="menu-item"><a href="404.html">404 Page</a></li>
                        </ul>
                    </li> --}}
                    <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
                <div class="header-right">
                    <a href="{{ route('rooms') }}" class="btn-book">BOOK YOUR STAY</a>
                </div>
            </div>
        </div>
    </div>
</header>
