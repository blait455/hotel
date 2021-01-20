@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">

            <div class="row">
                <h4 class="section-heading">Rooms</h4>
            </div>

            <div class="row">
                <div class="city-categories">
                    @foreach($types as $type)
                        <div class="col s12 m3">
                            <a href="{{ route('room.type', $type->id) }}">
                                <div class="city-category">
                                    <span>{{ $type->name }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">

                @foreach($rooms as $room)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                @if(Storage::disk('public')->exists('room/'.$room->image) && $room->image)
                                    <a href="{{ route('room.show',$room->slug) }}">
                                        <span class="card-image-bg" style="background-image:url({{Storage::url('room/'.$room->image)}});"></span>
                                    </a>
                                @else
                                    <span class="card-image-bg"><span>
                                @endif
                                @if($room->status == 1)
                                    <a class="btn-floating halfway-fab waves-effect waves-light indigo"><i class="small material-icons">star</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('room.show',$room->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $room->name }}">{{ \Illuminate\Support\Str::limit( $room->name, 18 ) }}</span>
                                </a>

                                <div class="address">
                                    <i class="small material-icons left">room_preferences</i>
                                    <span>{{ ucfirst($room->type->name) }}</span>
                                </div>

                                {{-- @foreach ($room->features as $feature)
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>{{ ucfirst($feature->name) }}</span>
                                    </div>
                                @endforeach --}}

                                <h5>
                                    <span>&#8358;</span>{{ $room->price }}
                                    <div class="right" id="propertyrating-{{$room->id}}"></div>
                                </h5>
                            </div>
                            <div class="card-action property-action">
                                @foreach ($room->features as $feature)
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        <strong>{{ $feature->name}}</strong>
                                    </span>
                                @endforeach
                                <span class="btn-flat">
                                    <i class="material-icons">comment</i>
                                    <strong>{{ $room->comments_count}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $rooms->links() }}
            </div>

        </div>
    </section>

@endsection

@section('scripts')

<script>

    $(function(){
        var js_rooms = <?php echo json_encode($rooms);?>;
        js_rooms.data.forEach(element => {
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
