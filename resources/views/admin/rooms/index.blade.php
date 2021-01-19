@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.rooms.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>ROOM LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Beds</th>
                                    <th>Status</th>
                                    {{-- <th><i class="material-icons small">comment</i></th>
                                    <th><i class="material-icons small">stars</i></th> --}}
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $rooms as $key => $room )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('room/'.$room->image) && $room->image)
                                            <img src="{{Storage::url('room/'.$room->image)}}" alt="{{$room->name}}" width="60" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{$room->name}}">
                                            {{ \Illuminate\Support\Str::limit($room->name, 10) }}
                                        </span>
                                    </td>
                                    <td>{{$room->price}}</td>
                                    <td>{{$room->type->name}}</td>
                                    <td>{{$room->beds}}</td>
                                    <td>
                                        @if($room->status == 1)
                                            <span class="badge bg-green">Available</span>
                                        @elseif($room->status == 0)
                                            <span class="badge bg-pink">Taken</span>
                                        @elseif($room->status == 2)
                                            <span class="badge bg-orange">Reserved</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <span class="badge bg-indigo">{{ $room->comments_count }}</span>
                                    </td>
                                    <td>
                                        @if($property->featured == true)
                                            <span class="badge bg-indigo"><i class="material-icons small">star</i></span>
                                        @endif
                                    </td> --}}

                                    <td class="text-center">
                                        <a href="{{route('admin.rooms.show',$room->id)}}" class="btn btn-success btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.rooms.edit',$room->id)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        {{-- @can('delete') --}}
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteRoom({{$room->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('admin.rooms.destroy',$room->id)}}" method="POST" id="del-room-{{$room->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script>
        function deleteRoom(id){

            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-room-'+id).submit();
                    swal(
                    'Deleted!',
                    'Room has been deleted.',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush
