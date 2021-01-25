@extends('frontend.layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/libs/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('content')

    <div id="main-content">
        <div class="page-title">
            <div class="page-title-wrapper" data-stellar-background-ratio="0.5">
                <div class="content container">
                    <h1 class="heading_primary">Room detail</h1>
                    <ul class="breadcrumbs">
                        <li class="item"><a href="url('/')">Home</a></li>
                        <li class="item"><span class="separator"></span></li>
                        <li class="item"><a href="{{ route('rooms') }}">Rooms</a></li>
                        <li class="item"><span class="separator"></span></li>
                        <li class="item active">{{ $room->name }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-content container">
            <div class="room-single row">
                <main class="site-main col-sm-12 col-md-9 flex-first">
                    <div class="room-wrapper">
                        <div class="post-media">
                            <img src="{{Storage::url('room/'.$room->image)}}" alt="">
                        </div>
                        <div class="title-share clearfix">
                            <h2 class="title">{{ $room->name }}</h2>
                            <div class="social-share">
                                <ul>
                                    <li><a class="link facebook" title="Facebook" href="http://www.facebook.com/sharer/sharer.php?u=#" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-facebook"></i></a></li>
                                    <li><a class="link twitter" title="Twitter" href="https://twitter.com/intent/tweet?url=#&amp;text=TheTitleBlog" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-twitter"></i></a></li>
                                    <li><a class="link google" title="Google" href="https://plus.google.com/share?url=#" rel="nofollow" onclick="window.open(this.href,this.title,'width=600,height=600,top=200px,left=200px');  return false;" target="_blank"><i class="ion-social-googleplus"></i></a>
                                </ul>
                            </div>
                        </div>
                        <div class="room_price">
                            <span class="price_value price_min"><span>&#8358;</span>{{ $room->price }}</span>
                            <span class="unit">Night</span>
                        </div>
                        <div class="description">
                            {!! $room->description !!}
                        </div>
                        <div class="room_additinal">
                            <h3 class="title style-01">AMENITIES AND SERVICES</h3>
                            <div class="row">
                                @foreach ($room->features as $feature)
                                    <div class="col-sm-4">
                                        <ul>
                                            <li><i class="fa fa-check"></i>{{ $feature->name }}</li><hr>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="room_review clearfix" id="room_review">
                            <h3 class="title style-01">{{ $room->comments_count }} &nbsp; REVIEWS</h3>
                            @foreach ($room->comments as $comment)
                                @if ($comment->parent_id == NULL)
                                    <div class="inner">
                                        <div class="avatar">
                                            <img src="{{ Storage::url('users/'.$comment->users->image) }}" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>{{ $comment->users->name }}</h4>
                                            @auth
                                                <span class="rating" id="rateYo"></span>
                                            @endauth
                                            <strong><small>{{ $comment->created_at->diffForHumans() }}</small></strong>
                                            <p>{{ $comment->body }}</p> <hr>
                                        </div>
                                        <div id="procomment-{{$comment->id}}"></div>
                                    </div>
                                @endif

                                @foreach ($comment->children as $commentchildren)
                                    <div class="inner">
                                        <div class="avatar">
                                            <img src="{{ Storage::url('users/'.$commentchildren->users->image) }}" alt="">
                                        </div>
                                        <div class="content">
                                            <h4>{{ $commentchildren->users->name }}</h4>
                                            <strong><small>{{ $commentchildren->created_at->diffForHumans() }}</small></strong>
                                            <p>{{ $commentchildren->body }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        @auth
                            <div class="form-review">
                                <h4 class="title"><i class="fa fa-pencil"></i>Add review</h4>
                                <form action="{{ route('room.comment',$room->id) }}" method="post" class="room_comment">
                                    @csrf
                                    <input type="hidden" name="parent" value="0">
                                    <p>Your rating</p>
                                    <p><span class="rating-star empty"></span></p>
                                    <p>Your review</p>
                                    <textarea rows="5" cols="8" name="body" required placeholder=""></textarea>
                                    <button type="submit" class="submit">Submit</button>
                                </form>
                            </div>
                        @endauth
                        @guest
                            <div class="comment-login">
                                <h6>Please Login to comment</h6>
                                <a href="{{ route('login') }}" class="submit">Login</a>
                            </div>
                        @endguest
                    </div>
                </main>
                <aside id="secondary" class="widget-area col-sm-12 col-md-3 sticky-sidebar">
                    <div class="wd wd-book-room">
                        <a href="#" class="book-room">Book This Room</a>
                        <div id="form-popup-room" class="form-popup-room">
                            <div class="popup-container">
                                <a href="#" class="close-popup"><i class="ion-android-close"></i></a>
                                <form id="hotel-popup-results" name="hb-search-single-room" class="hotel-popup-results" action="{{route('admin.bookings.store')}}" method="POST" enctype="multipart/form-data">
                                    <div class="room-head">
                                        <h3 class="room-title">{{ $room->name }}</h3>
                                        <p class="description">*Note: Bookings are verified before reservations can be made</p>
                                    </div>
                                    <div class="search-room-popup">
                                        <ul class="form-table clearfix">
                                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                                            <li class="form-field">
                                                <input type="text" name="name" id="name" required class="name" placeholder="Your Name*">
                                            </li>
                                            <li class="form-field">
                                                <input type="email" name="email" id="email" required class="email" placeholder="Your Email*">
                                            </li>
                                            <li class="form-field">
                                                <input type="tel" name="phone" id="phone" required class="phone" placeholder="Your Phone*">
                                            </li>
                                            <li class="form-field">
                                                <input type="text" name="add" id="add" required class="add" placeholder="Your Address*">
                                            </li>
                                            <li class="form-field">
                                                <input type="text" name="check_in_date" id="popup_check_in_date" required class="check_in_date" placeholder="Arrival Date">
                                            </li>
                                            <li class="form-field">
                                                <input type="text" name="check_out_date" id="popup_check_out_date" required class="check_out_date " placeholder="Departure Date">
                                            </li>
                                            <li class="form-field">
                                                <input type="text" name="price" id="price" required class="price" placeholder="Price">
                                            </li>
                                            <li class="form-field">
                                                <input type="file" name="pop" id="pop" required class="form-control" placeholder="Proof of payment">
                                            </li>

                                            <li class="form-field room-submit">
                                                <button id="check_date" class="submit" type="submit">Book Now</button>
                                            </li>
                                        </ul>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="wd wd-check-room">
                        <h3 class="title">AVAILABILITY</h3>
                            <div class="room-submit">
                                @if ($room->status)
                                    <button>Unavailable</button>
                                @else
                                    <button>Available &nbsp; &nbsp;<i class="fa fa-check"></i></button>
                                @endif
                            </div>
                    </div>
                </aside>
            </div>
        </div>

    </div>

    RATING --
    @php
        $rating = ($rating == null) ? 0 : $rating;
    @endphp

@endsection

@section('scripts')

    <script>
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // RATING
            $("#rateYo").rateYo({
                rating: <?php echo json_encode($rating); ?>,
                halfStar: true,
                starWidth: "26px"
            })
            .on("rateyo.set", function (e, data) {

                var rating = data.rating;
                var room_id = <?php echo json_encode($room->id); ?>;
                var user_id = <?php echo json_encode( auth()->id() ); ?>;

                $.post( "{{ route('room.rating') }}", { rating: rating, room_id: room_id, user_id: user_id }, function( data ) {
                    if(data.rating.rating){
                        M.toast({html: 'Rating: '+ data.rating.rating + ' added successfully.', classes:'green darken-4'})
                    }
                });
            });


            // COMMENT
            $(document).on('click','#commentreplay',function(e){
                e.preventDefault();

                var commentid = $(this).data('commentid');

                $('#procomment-'+commentid).empty().append(
                    `<div class="comment-box">
                        <form action="{{ route('room.comment',$room->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent" value="1">
                            <input type="hidden" name="parent_id" value="`+commentid+`">

                            <textarea name="body" class="box" placeholder="Leave a comment"></textarea>
                            <input type="submit" class="btn indigo" value="Comment">
                        </form>
                    </div>`
                );
            });
        })
    </script>
@endsection
