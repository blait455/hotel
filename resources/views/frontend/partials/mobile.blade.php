<nav class="visible-xs mobile-menu-container mobile-effect" itemscope itemtype="">
    <div class="inner-off-canvas">
        <div class="menu-mobile-effect navbar-toggle">Close <i class="fa fa-times"></i></div>
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

            <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </div>
</nav><!-- nav.mobile-menu-container -->
