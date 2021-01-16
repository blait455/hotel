<footer class="page-footer indigo darken-2">
    <div class="container">
        <div class="row">
            <div class="col m4 s12">
                <h5 class="white-text uppercase">About Us</h5>
                @if(isset($footersettings[0]) && $footersettings[0]['about'])
                    <p class="grey-text text-lighten-4">{{ $footersettings[0]['about'] }}</p>
                @else
                    <p class="grey-text text-lighten-4">BLAITlabs</p>
                @endif
            </div>

            <div class="col m6 s12">
                <h5 class="white-text uppercase">Recent Jobs</h5>
                <ul class="collection border0">
                </ul>
            </div>
            <div class="col m2 s12">
                <h5 class="white-text uppercase">Menu</h5>
                <ul>
                    {{-- <li class="uppercase {{ Request::is('gallery*') ? 'underline' : '' }}">
                        <a href="{{ route('gallery') }}" class="grey-text text-lighten-3">Gallery</a>
                    </li>

                    <li class="uppercase {{ Request::is('blog*') ? 'underline' : '' }}">
                        <a href="{{ route('blog') }}" class="grey-text text-lighten-3">Blog</a>
                    </li>

                    <li class="uppercase {{ Request::is('contact') ? 'underline' : '' }}">
                        <a href="{{ route('contact') }}" class="grey-text text-lighten-3">Contact</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            @if(isset($footersettings[0]) && $footersettings[0]['footer'])
                &copy; <script>document.write(new Date().getFullYear());</script> {{ $footersettings[0]['footer'] }}
            @else
                <p> &copy; <script>document.write(new Date().getFullYear());</script> <a href="https://blait.com" target="_blank">BLAITlabs</a></p>

            @endif

            @if(isset($footersettings[0]) && $footersettings[0]['facebook'])
                <a class="grey-text text-lighten-4 right" href="{{ $footersettings[0]['facebook'] }}" target="_blank">FACEBOOK</a>
            @endif
            @if(isset($footersettings[0]) && $footersettings[0]['twitter'])
                <a class="grey-text text-lighten-4 right m-r-10" href="{{ $footersettings[0]['twitter'] }}" target="_blank">TWITTER</a>
            @endif
            @if(isset($footersettings[0]) && $footersettings[0]['linkedin'])
                <a class="grey-text text-lighten-4 right m-r-10" href="{{ $footersettings[0]['linkedin'] }}" target="_blank">LINKEDIN</a>
            @endif

        </div>
    </div>
</footer>