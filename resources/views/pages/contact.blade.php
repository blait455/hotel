@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <div id="main-content">
        <div class="page-title">
            <div class="page-title-wrapper" data-stellar-background-ratio="0.5">
                <div class="content container">
                    <h1 class="heading_primary">Contact</h1>
                    <ul class="breadcrumbs">
                        <li class="item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="item"><span class="separator"></span></li>
                        <li class="item active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-content no-padding">
            <div class="page-content">
                <div class="container">
                    <div class="empty-space"></div>
                    <div class="row tm-flex">
                        <div class="col-sm-6">
                            <div class="sc-heading">
                                <p class="first-title">SEND A</p>
                                <h3 class="second-title">MESSAGE</h3>
                                <p class="description">Do you have anything in your mind to tell us? <br>
                                    Please don't hesitate to get in touch to us via our contact form.</p>
                            </div>

                            <div class="sc-contact-form">
                                <form action="{{ route('contact.message') }}" id="ajaxform" method="post">
                                    @csrf
                                    <input type="hidden" name="mailto" value="{{ $contactsettings[0]['email'] ?? 'blait455@gmail.com' }}">
                                    @auth
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    @endauth

                                    <input type="text" name="name" required placeholder="Your name*">
                                    <input type="email" name="email" required placeholder="Your email*">
                                    <input type="tel" name="phone" required placeholder="Your phone*">
                                    <textarea name="message" id="your-message" cols="30" rows="10" required placeholder="Your message*"></textarea>
                                    <input type="submit" class="submit" value="Send message">
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="sc-contact-info">
                                <div class="sc-heading">
                                    <p class="first-title">GET IN TOUCH</p>
                                    <p class="description"><a href="contact.html#google-map">{!! $contactsettings[0]['address'] !!}</a></p>
                                </div>
                                <p class="phone">Call. <a href="tel:{{ $contactsettings[0]['phone'] }}">{{ $contactsettings[0]['phone'] }}</a></p>
                                <p class="email"><a href="mailto:{{ $contactsettings[0]['email'] }}">{{ $contactsettings[0]['email'] }}</a></p>
                                <ul class="sc-social-link style-03">
                                    <li><a target="_blank" class="face" href="https://www.facebook.com"
                                        title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a target="_blank" class="twitter" href="https://www.twitter.com"
                                        title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a target="_blank" class="skype" href="skype:hotamdhv?call" title="Skype"><i
                                            class="fa fa-skype"></i></a></li>
                                    <li><a class="instagram" href="http://www.thimpress.com/" title="Instagram"><i
                                            class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div><br><br>
                {{-- <div class="sc-google-map" id="sc-google-map">
                    <div class="empty-space"></div>
                    <div id="google-map"></div>
                </div> --}}
            </div>
        </div>
    </div>


    {{-- <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m8">
                    <div class="contact-content">
                        <h4 class="contact-title">Contact Us</h4>

                        <form id="contact-us" action="" method="POST">
                            @csrf
                            <input type="hidden" name="mailto" value="{{ $contactsettings[0]['email'] ?? 'p4alam@gmail.com' }}">

                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            @endauth

                            @auth
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <input id="name" name="name" type="text" class="validate" value="{{ auth()->user()->name }}" readonly>
                                    <label for="name">Name</label>
                                </div>
                            @endauth
                            @guest
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person</i>
                                    <input id="name" name="name" type="text" class="validate">
                                    <label for="name">Name</label>
                                </div>
                            @endguest

                            @auth
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" name="email" type="email" class="validate" value="{{ auth()->user()->email }}" readonly>
                                    <label for="email">Email</label>
                                </div>
                            @endauth
                            @guest
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" name="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                </div>
                            @endguest

                            <div class="input-field col s12">
                                <i class="material-icons prefix">phone</i>
                                <input id="phone" name="phone" type="number" class="validate">
                                <label for="phone">Phone</label>
                            </div>

                            <div class="input-field col s12">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="message" name="message" class="materialize-textarea"></textarea>
                                <label for="message">Message</label>
                            </div>

                            <button id="msgsubmitbtn" class="btn waves-effect waves-light indigo darken-4 btn-large" type="submit">
                                <span>SEND</span>
                                <i class="material-icons right">send</i>
                            </button>

                        </form>

                    </div>
                </div> <!-- /.col -->

                <div class="col s12 m4">
                    <div class="contact-sidebar">
                        <div class="m-t-30">
                            <i class="material-icons left">call</i>
                            <h6 class="uppercase">Call us Now</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['phone'])
                                <h6 class="bold m-l-40">{{ $contactsettings[0]['phone'] }}</h6>
                            @endif
                        </div>
                        <div class="m-t-30">
                            <i class="material-icons left">mail</i>
                            <h6 class="uppercase">Email Address</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['email'])
                                <h6 class="bold m-l-40">{{ $contactsettings[0]['email'] }}</h6>
                            @endif
                        </div>
                        <div class="m-t-30">
                            <i class="material-icons left">map</i>
                            <h6 class="uppercase">Address</h6>
                            @if(isset($contactsettings[0]) && $contactsettings[0]['address'])
                                <h6 class="bold m-l-40">{!! $contactsettings[0]['address'] !!}</h6>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}

@endsection

@section('scripts')
    <script>
        $('textarea#message').characterCounter();

        $(function(){
            $(document).on('submit','#contact-us',function(e){
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('contact.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function() {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('<span>LOADING...</span><i class="material-icons right">rotate_right</i>');
                    },
                    success: function(data) {
                        if (data.message) {
                            M.toast({html: data.message, classes:'green darken-4'})
                        }
                    },
                    error: function(xhr) {
                        M.toast({html: 'ERROR: Failed to send message!', classes: 'red darken-4'})
                    },
                    complete: function() {
                        $('form#contact-us')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('<span>SEND</span><i class="material-icons right">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })

    </script>
@endsection
