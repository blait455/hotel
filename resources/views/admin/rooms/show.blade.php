@extends('backend.layouts.app')

@section('title', 'Show Room')

@push('styles')


@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">

                <div class="header bg-indigo">
                    <h2>SHOW ROOM</h2>
                </div>

                <div class="header">
                    <h2>
                        {{$room->name}}
                        <br>
                        <small>Posted on {{$room->created_at->toFormattedDateString()}}</small>
                    </h2>
                </div>

                <div class="header">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Price : </strong>
                            <span class="right"> <span>&#8358;</span>{{$room->price}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Type : </strong>
                            <span class="right">{{$room->type->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Beds : </strong>
                            <span class="right">{{$room->beds}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Floor : </strong>
                            <span class="right">{{$room->floor}}</span>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <h5>Description</h5>
                    {!!$room->description!!}
                </div>
            </div>

            @if(!$room->gallery->isEmpty())
            <div class="card">
                <div class="header bg-red">
                    <h2>GALLERY IMAGE</h2>
                </div>
                <div class="body">
                    <div class="gallery-box">
                        @foreach($room->gallery as $gallery)
                        <div class="gallery-image">
                            <img class="img-responsive" src="{{Storage::url('room/gallery/'.$gallery->name)}}" alt="{{$room->name}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- COMMENTS --}}
            <div class="card">
                <div class="header">
                    <h2>{{ $room->comments_count }} Comments</h2>
                </div>
                <div class="body">

                    @foreach($room->comments as $comment)

                        @if($comment->parent_id == NULL)
                            <div class="comment">
                                <div class="author-image">
                                    <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                </div>
                                <div class="content">
                                    <div class="author-name">
                                        <strong>{{ $comment->users->name }}</strong>
                                        <span class="right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="author-comment">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach($comment->children as $comment)
                            <div class="comment children">
                                <div class="author-image">
                                    <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                </div>
                                <div class="content">
                                    <div class="author-name">
                                        <strong>{{ $comment->users->name }}</strong>
                                        <span class="right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="author-comment">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endforeach

                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-green">
                    <h2>FEATURES</h2>
                </div>
                <div class="body">
                    @foreach($room->features as $feature)
                        <span class="label bg-green">{{$feature->name}}</span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-amber">
                    <h2>FEATURED IMAGE</h2>
                </div>
                <div class="body">

                    <img class="img-responsive thumbnail" src="{{Storage::url('room/'.$room->image)}}" alt="{{$room->name}}">

                    <a href="{{route('admin.rooms.index')}}" class="btn btn-danger btn-lg waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>BACK</span>
                    </a>
                    <a href="{{route('admin.rooms.edit',$room->id)}}" class="btn btn-info btn-lg waves-effect">
                        <i class="material-icons">edit</i>
                        <span>EDIT</span>
                    </a>

                </div>
            </div>
        </div>

    </div>


@endsection


@push('scripts')

@endpush
