@extends('frontend.layouts.app')

@section('content')


    <div id="home-main-content" class="home-main-content home-1">
        <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="home-1"
            data-source="gallery"
            style="padding:0px;background-image:url('{{ asset("frontend/images/hotel-bg.jpg") }}');background-repeat:no-repeat;background-size:cover;background-position:center center;">
            <!-- START REVOLUTION SLIDER 5.4.7.4 fullwidth mode -->
            <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.7.4">
                <ul>    <!-- SLIDE  -->
                    @foreach ($sliders as $slider)
                        <li data-index="rs-10" data-transition="fade" data-slotamount="default" data-hideafterloop="0"
                            data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300"
                            data-thumb="images/slides/h1-slider1-100x50.jpg" data-rotate="0" data-saveperformance="off"
                            data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5=""
                            data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{Storage::url('slider/'.$slider->image)}}" alt="" title="hotel-wp-demo3-slider.jpg" width="1422"
                                height="800" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <h1 class="tp-caption   tp-resizeme"
                                id="slide-10-layer-1"
                                data-x="['center','center','center','center']" data-hoffset="['8','8','8','7']"
                                data-y="['middle','middle','middle','middle']" data-voffset="['-109','-109','-109','-62']"
                                data-fontsize="['66','66','40','30']"
                                data-lineheight="['78','78','50','36']"
                                data-fontweight="['700','700','700','700']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"

                                data-type="text"
                                data-responsive_offset="on"

                                data-frames='[{"delay":900,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":100,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]'
                                data-textAlign="['center','center','center','center']"
                                data-paddingtop="[0,0,0,0]"
                                data-paddingright="[0,0,0,0]"
                                data-paddingbottom="[0,0,0,0]"
                                data-paddingleft="[0,0,0,0]"

                                style="z-index: 5; white-space: nowrap; font-size: 66px; line-height: 78px; font-weight: 700; color: rgba(255,255,255,1);">{{ $slider->title }}</h1>

                            <!-- LAYER NR. 2 -->
                            <p class="tp-caption   tp-resizeme"
                            id="slide-10-layer-2"
                            data-x="['center','center','center','center']" data-hoffset="['0','0','1','1']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['5','5','-24','12']"
                            data-width="none"
                            data-height="none"
                            data-whitespace="nowrap"

                            data-type="text"
                            data-responsive_offset="on"

                            data-frames='[{"delay":900,"speed":1500,"frame":"0","from":"y:bottom;rX:-20deg;rY:-20deg;rZ:0deg;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"y:[-100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"nothing"}]'
                            data-textAlign="['left','left','left','left']"
                            data-paddingtop="[0,0,0,0]"
                            data-paddingright="[0,0,0,0]"
                            data-paddingbottom="[0,0,0,0]"
                            data-paddingleft="[0,0,0,0]"

                            style="z-index: 6; white-space: nowrap; font-size: 18px; line-height: 22px; font-weight: 400; color: rgba(255,255,255,1);">{{ $slider->description }}</p>

                            <!-- LAYER NR. 3 -->
                        </li>
                    @endforeach
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div><!-- END REVOLUTION SLIDER -->

        <div class="container">
            <div class="sc-hb-rooms-search style-01">
                <div class="hotel-booking-search style-01">
                    <form action="rooms-search.html" class="hb-search-form">
                        <ul class="hb-form-table">
                            <li><input type="text" id="multidate" class="multidate" value="" data-date-min="6" /></li>
                            <li class="hb-form-field hb-form-check-in">
                                <div class="label">Check-In</div>
                                <div class="hb-form-field-input hb_input_field">
                                    <input type="text" id="day" class="day" value=""  style="width: 68px;" />
                                    <input id="month" class="month"  type="text" value="" />
                                    <input type="hidden" name="check_in_date" id="check_in_date" class="check-date hasDatepicker" value="" />
                                </div>
                            </li>

                            <li class="hb-form-field hb-form-check-out">
                                <div class="label">Check-Out</div>
                                <div class="hb-form-field-input hb_input_field">
                                    <input type="text" id="day2" class="day" value=""  style="width: 83px;" />
                                    <input id="month2" class="month"  type="text" value="" />
                                    <input type="hidden" name="check_out_date" id="check_out_date" class="check-date hasDatepicker" value="" />
                                </div>
                            </li>

                            <li class="hb-form-field hb-form-number">
                                <div class="label">Number</div>
                                <div id="guests" class="hb-form-field-input hb_input_field">
                                    <input type="text" id="number" class="day" value="01" />
                                    <input class="month" type="text" value="Guests" />
                                </div>
                                <div class="hb-form-field-list">
                                    <div class="hb-form-field-input hb-guest-field">
                                        <select name="adults_capacity" tabindex="-1" aria-hidden="true">
                                            <option value="47">1</option>
                                            <option value="45">2</option>
                                            <option value="56">3</option>
                                            <option value="57">4</option>
                                            <option value="58">5</option>
                                            <option value="59">6</option>
                                            <option value="60">7</option>
                                            <option value="61">8</option>
                                            <option value="62">9</option>
                                        </select>
                                        <span class="name">Guests</span>
                                        <span class="number-icons goUp"><i class="ion-plus"></i></span>
                                        <span class="number-icons goDown"><i class="ion-minus"></i></span>
                                    </div>
                                </div>
                            </li>

                        </ul>
                        <p class="hb-submit">
                            <span class="contact-info">Need Help: <span>(+12) 34-567-89</span></span>
                            <button type="submit">Check Availability</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="empty-space"></div>
        <div class="h1-introduce">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="sc-heading style-02">
                            <h3 class="title">Comfort is perfectly combined here</h3>
                            <div class="description">
                                <p>This charming private 19th century mansion, which originally belonged to the family, has been completely renovated with care & passion while respecting the spirit of place.</p>
                                <p>Divo Hotel surrounded herself by a team of French artisans to create a sophisticated place in a refined.</p>
                            </div>
                            <div class="head-button">
                                <a href="about-us.html" class="more-info">More Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sc-img-box row">
                            {{-- <div class="col-sm-6">
                                <a href="gallery-full-width.html"><img src="{{ asset('frontend/images/home/h1-img1.jpg') }}" alt=""></a>
                            </div>
                            <div class="col-sm-6">
                                <a href="gallery-full-width.html"><img src="{{ asset('frontend/images/home/h1-img1.jpg') }}" alt=""></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space"></div>
        <div class="h1-video rectangle-overlay">
            <div class="sc-video">
                <div class="background-video">
                    <div class="cover-image"></div>
                    <div class="content container">
                        <h3 class="title">Summer is here. Get ready <br> to enjoy it!</h3>
                        <i class="video-play ion-ios-play"></i>
                        <span class="text-icon">Play Video</span>
                    </div>
                    <video loop="" class="full-screen-video" data-autoplay="">
                        <source src="{{ asset('frontend/images/home/hotel.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="sc-list-box style-01">
                <div class="container">
                    <div class="list-box-slider owl-carousel owl-theme">
                        <div class="box-item">
                            <i class="ion-ribbon-a "></i>
                            <h5 class="box-title">Rooms</h5>
                            <p class="description">Lose yourself in the lush textures, rich colors and French amenities.</p>
                            <a href="rooms.html" class="btn-link">Take a look</a>
                        </div>
                        <div class="box-item">
                            <i class="ion-ios-flower"></i>
                            <h5 class="box-title">Aqua Spa</h5>
                            <p class="description">Finnish sauna and gym, comfortable massage rooms.</p>
                            <a href="rooms.html" class="btn-link">Take a look</a>
                        </div>
                        <div class="box-item">
                            <i class="ion-ios-nutrition "></i>
                            <h5 class="box-title">Restaurants</h5>
                            <p class="description">Discover our global cuisine, set menus, extensive wine list.</p>
                            <a href="rooms.html" class="btn-link">Take a look</a>
                        </div>
                        <div class="box-item">
                            <i class="ion-wifi "></i>
                            <h5 class="box-title">Wifi</h5>
                            <p class="description">Finnish sauna and gym, comfortable massage rooms.</p>
                            <a href="rooms.html" class="btn-link">Take a look</a>
                        </div>
                        <div class="box-item">
                            <i class="ion-bonfire "></i>
                            <h5 class="box-title">Activity</h5>
                            <p class="description">For the perfect family holidays.</p>
                            <a href="rooms.html" class="btn-link">Take a look</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="group-destination">
            <div class="sc-content-overlay">
                <div class="container">
                    <div class="empty-space"></div>
                    <div class="sc-heading style-01 text-center">
                        <h3 class="title">Our Services</h3>
                        <p class="description">For anything that brings people together to celebrate an occasion, we create truly memorable experiences that you will cherish forever</p>
                    </div>
                    <div class="sc-posts style-01 auto-height">
                        <div class="item row">
                            @foreach ($services as $service)
                                <div class="post col-sm-6 col-md-4">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            @if (Storage::disk('public')->exists('service/'.$service->image) && $service->image)
                                                <a href="room-single.html"><img src="{{ Storage::url('service/'.$service->image) }}" alt=""></a>
                                            @else
                                                <a href="room-single.html"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <h2 class="title"> <a href="blog-single.html">{{ $service->title }}</a></h2>
                                            <div class="short-text">2 Day 3 night, Start from $500</div>
                                            <div class="summary">{{ $service->description }}</div>
                                            <a href="" class="read-more"></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="h1-banner">
            <div class="sc-content-overlay">
                <div class="container rectangle-overlay">
                    <div class="sc-box style-01 text-center">
                        <h3 class="title">Get up to 20% off on your next
                            <br>lodging</h3>
                        {{-- <p class="description">Choose the package you would like to offer to your clients and
                            <br> send us an inquiry using the contact form.</p> --}}
                        <div class="button-box"><a href="#" class="btn-box">Book now</a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="h1-rooms">
            <div class="sc-content-overlay">
                <div class="empty-space"></div>
                <div class="container">
                    <div class="sc-heading style-01 text-center">
                        <h3 class="title">Awesome Rooms</h3>
                        <p class="description">For anything that brings people together to celebrate an occasion, we create truly memorable experiences that you will cherish forever</p>
                    </div>
                    <div class="sc-rooms style-01">
                        <div class="rooms-content layout-grid style-01">
                            <div class="row">
                                @foreach ($rooms as $room)
                                    <div class="room col-sm-4 clearfix">
                                        <div class="room-item">
                                            <div class="room-media">
                                                @if (Storage::disk('public')->exists('room/'.$room->image) && $room->image)
                                                    <a href="{{ route('room.show',$room->slug) }}"><img src="{{ Storage::url('room/'.$room->image) }}" alt=""></a>
                                                @else
                                                    <a href="{{ route('room.show',$room->slug) }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                                @endif
                                            </div>
                                            <div class="room-summary">
                                                <h3 class="room-title">
                                                    <a href="{{ route('room.show',$room->slug) }}">{{ $room->name }}</a>
                                                </h3>
                                                <div class="room-price">From: <span class="price">&#8358;{{ $room->price }}</span></div>
                                                <p class="room-description">{!! \Illuminate\Support\Str::limit($room->description, 70) !!}</p>
                                                <div class="room-meta clearfix">
                                                    <div class="comment-count">{{ $room->comments_count}} Reviews</div>
                                                    {{-- <div class="rating"><span class="star"></span>(5/5)</div> --}}
                                                    <div class="rating" id="propertyrating-{{$room->id}}"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="empty-space"></div>
            </div>
        </div>

        <div class="h1-bg-testimonial">
            <div class="sc-content-overlay">
                <div class="container rectangle-overlay">
                    <div class="sc-testimonials style-01">
                        <h3 class="heading">Comments from our happy <br> Guests</h3>
                        <div class="testimonial-slider" data-itemsvisible="3" data-nav="false">
                            @foreach ($testimonials as $testimonial)
                                <div class="item">
                                    <div class="content">
                                        <div class="image">
                                            <img src="{{ Storage::url('testimonial/'.$testimonial->image) }}" alt="">
                                        </div>
                                        <div class="rating-star"></div>
                                        <div class="description">
                                            {{ $testimonial->testimonial }}
                                        </div>
                                        <div class="user-info">
                                            <h4 class="name">{{ $testimonial->name }}</h4>
                                            {{-- <div class="regency">Manager</div> --}}
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="group-destination">
            <div class="sc-content-overlay">
                <div class="container">
                    <div class="empty-space"></div>
                    <div class="sc-heading style-01 text-center">
                        <h3 class="title">Latest News</h3>
                        <p class="description">For anything that brings people together to celebrate an occasion, we create truly memorable experiences that you will cherish forever</p>
                    </div>
                    <div class="sc-posts style-01">
                        <div class="row">
                                <div class="item-first col-sm-12 col-md-6">
                                    <div class="post col-sm-12 col-md-12">
                                        <div class="inner">
                                            <div class="thumbnail">
                                                <a href="blog-single.html"><img src="{{ Storage::url('posts/'.$event->image) }}" alt=""></a>
                                            </div>
                                            <div class="content">
                                                <div class="category"><a href="#">{{ $event->categories[0]->name }}</a></div>
                                                <h3 class="title"> <a href="blog-single.html">{{ $event->title }}</a></h3>
                                                <div class="date"><i class="ion-android-calendar"></i>15 July, 2020</div>
                                                <div class="summary">{!!  \Illuminate\Support\Str::limit($event->body,120) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="item col-sm-12 col-md-6">
                                @foreach ($posts as $post)
                                    <div class="post col-sm-6 col-md-6">
                                        <div class="inner">
                                            <div class="thumbnail">
                                                <a href="blog-single.html"><img src="{{Storage::url('posts/'.$post->image)}}" alt=""></a>
                                            </div>
                                            <div class="content">
                                                <div class="category"><a href="#">{{ $post->categories[0]->name }}</a></div>
                                                <h3 class="title"> <a href="blog-single.html">{{ $post->title }}</a></h3>
                                                <div class="summary">{!!  \Illuminate\Support\Str::limit($post->body,120) !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- <div class="empty-space"></div>
                    <div class="sc-heading style-01 text-center">
                        <h3 class="title">Our Gallery</h3>
                        <p class="description">For anything that brings people together to celebrate an occasion, we create truly memorable experiences that you will cherish forever</p>
                    </div>

                    <div class="sc-gallery style-01">
                        <div class="gallery-slider owl-carousel owl-theme">
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-1" class="btn-gallery"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    <div id="gallery-1" class="hidden">
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Rooms</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <div class="gallery">
                                        <a href="#gallery-2" class="btn-gallery"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <div id="gallery-2" class="hidden">
                                            <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                            <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                            <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Restaurant</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-3" class="btn-gallery"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    <div id="gallery-3" class="hidden">
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Events</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-4" class="btn-gallery"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    <div id="gallery-4" class="hidden">
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                        <a  href="{{ asset('frontend/images/gallery/img-1.jpg') }}"><img src="{{ asset('frontend/images/gallery/img-1.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Activities</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-5" class="btn-gallery"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    <div id="gallery-5" class="hidden">
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    </div>
                                </div>

                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Beach</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-7" class="btn-gallery"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    <div id="gallery-6" class="hidden">
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Spa</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                            <div class="item">
                                <div class="gallery">
                                    <a href="#gallery-7" class="btn-gallery"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    <div id="gallery-7" class="hidden">
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                        <a  href="images/gallery/img-1.jpg"><img src="images/gallery/img-1.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="title"><a href="blog-single-gallery.html">Outdoor</a></h4>
                                    <span class="count">3 photos</span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="empty-space"></div>
                </div>
            </div>
        </div>
    </div>





    <!-- SERVICE SECTION -->

    {{-- <section class="section grey lighten-4 center">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Services</h4>
            </div>
            <div class="row">
                @foreach($services as $service)
                    <div class="col s12 m4">
                        <div class="card-panel">
                            <i class="material-icons large indigo-text">{{ $service->icon }}</i>
                            <h5>{{ $service->title }}</h5>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <!-- FEATURED SECTION -->

    {{-- <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Featured Properties</h4>
            </div>
            <div class="row">

                @foreach($properties as $property)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                    <span class="card-image-bg" style="background-image:url({{Storage::url('property/'.$property->image)}});"></span>
                                @else
                                    <span class="card-image-bg"><span>
                                @endif
                                @if($property->featured == 1)
                                    <a class="btn-floating halfway-fab waves-effect waves-light indigo" title="Featured"><i class="small material-icons">star</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('property.show',$property->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->title }}">{{ str_limit( $property->title, 18 ) }}</span>
                                </a>

                                <div class="address">
                                    <i class="small material-icons left">location_city</i>
                                    <span>{{ ucfirst($property->city) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">place</i>
                                    <span>{{ ucfirst($property->address) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">check_box</i>
                                    <span>{{ ucfirst($property->type) }} for {{ $property->purpose }}</span>
                                </div>

                                <h5>
                                    &dollar;{{ $property->price }}
                                    <div class="right" id="propertyrating-{{$property->id}}"></div>
                                </h5>
                            </div>
                            <div class="card-action property-action">
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Bedroom: <strong>{{ $property->bedroom}}</strong>
                                </span>
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Bathroom: <strong>{{ $property->bathroom}}</strong>
                                </span>
                                <span class="btn-flat">
                                    <i class="material-icons">check_box</i>
                                    Area: <strong>{{ $property->area}}</strong> Square Feet
                                </span>
                                <span class="btn-flat">
                                    <i class="material-icons">comment</i>
                                    <strong>{{ $property->comments_count}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section> --}}


    <!-- TESTIMONIALS SECTION -->

    {{-- <section class="section grey lighten-3 center">
        <div class="container">

            <h4 class="section-heading">Testimonials</h4>

            <div class="carousel testimonials">

                @foreach($testimonials as $testimonial)
                    <div class="carousel-item testimonial-item" href="#{{$testimonial->id}}!">
                        <div class="card testimonial-card">
                            <span style="height:20px;display:block;"></span>
                            <div class="card-image testimonial-image">
                                <img src="{{Storage::url('testimonial/'.$testimonial->image)}}">
                            </div>
                            <div class="card-content">
                                <span class="card-title">{{$testimonial->name}}</span>
                                <p>
                                    {{$testimonial->testimonial}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section> --}}


    <!-- BLOG SECTION -->

    {{-- <section class="section center">
        <div class="row">
            <h4 class="section-heading">Recent Blog</h4>
        </div>
        <div class="container">
            <div class="row">

                @foreach($posts as $post)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            @if(Storage::disk('public')->exists('posts/'.$post->image) && $post->image)
                                <span class="card-image-bg" style="background-image:url({{Storage::url('posts/'.$post->image)}});"></span>
                            @endif
                        </div>
                        <div class="card-content">
                            <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{$post->title}}">
                                <a href="{{ route('blog.show',$post->slug) }}">{{ str_limit($post->title,18) }}</a>
                            </span>
                            {!! str_limit($post->body,120) !!}
                        </div>
                        <div class="card-action blog-action">
                            <a href="{{ route('blog.author',$post->user->username) }}" class="btn-flat">
                                <i class="material-icons">person</i>
                                <span>{{$post->user->name}}</span>
                            </a>
                            @foreach($post->categories as $key => $category)
                                <a href="{{ route('blog.categories',$category->slug) }}" class="btn-flat">
                                    <i class="material-icons">folder</i>
                                    <span>{{$category->name}}</span>
                                </a>
                            @endforeach
                            @foreach($post->tags as $key => $tag)
                                <a href="{{ route('blog.tags',$tag->slug) }}" class="btn-flat">
                                    <i class="material-icons">label</i>
                                    <span>{{$tag->name}}</span>
                                </a>
                            @endforeach
                            <a href="#" class="btn-flat disabled">
                                <i class="material-icons">watch_later</i>
                                <span>{{$post->created_at->diffForHumans()}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section> --}}

@endsection

@section('scripts')
    <script>
        $(function(){
            var js_properties = <?php echo json_encode($rooms);?>;
            js_properties.forEach(element => {
                if(element.rating){
                    var elmt = element.rating;
                    var sum = 0;
                    for( var i = 0; i < elmt.length; i++ ){
                        sum += parseFloat( elmt[i].rating );
                    }
                    var avg = sum/elmt.length;
                    if(isNaN(avg) == false){
                        $("#propertyrating-"+element.id).rateYo({
                            rating: avg,
                            starWidth: "20px",
                            readOnly: true
                        });
                    }else{
                        $("#propertyrating-"+element.id).rateYo({
                            rating: 0,
                            starWidth: "20px",
                            readOnly: true
                        });
                    }
                }
            });
        })
    </script>
@endsection
