@extends('backend.layouts.app')

@section('title', 'Bookings')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.bookings.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREATE </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>BOOKING LIST</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Room</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $bookings as $key => $booking )
                                <tr>
                                    <td>{{ $key+1}}</td>
                                    <td>{{ $booking->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $booking->guest->name }}</td>
                                    <td>{{ $booking->guest->email }}</td>
                                    <td>{{ $booking->guest->phone }}</td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td><span>&#8358;</span>{{ $booking->room->price }}</td>
                                    <td>
                                        @if($booking->status == true)
                                            <span class="badge bg-green">Reserved</span>
                                        @else
                                            <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.bookings.edit',$booking->id) }}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        {{-- @can('delete') --}}
                                            <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteBooking({{ $booking->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('admin.bookings.destroy',$booking->id)}}" method="POST" id="del-booking-{{$booking->id}}" style="display:none;">
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
        function deleteBooking(id){

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
                    document.getElementById('del-booking-'+id).submit();
                    swal(
                    'Deleted!',
                    'Booking has been deleted.',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush
