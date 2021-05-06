@extends('backend.layouts.app')

@section('title', 'Create Post')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.sr.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>CREATE STORE RECORDS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped " id="tab_logic">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL.</th>
                                        <th>Item</th>
                                        <th>Opening stock</th>
                                        <th>Supplied</th>
                                        <th>Issued</th>
                                        <th>Closing stock</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr id="addr0">
                                        <td class="text-center">1</td>

                                        <td>
                                            <select name="record_item_id[]">
                                                <option value="">Select item</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="opening_stock[]" required></td>
                                        <td><input type="text" name="supplied[]" required></td>
                                        <td><input type="text" name="issued[]" required></td>
                                        <td><input type="text" name="closing_stock[]" required></td>
                                        <td><input type="text" name="remark[]" required></td>
                                    </tr>
                                    <tr id="addr1"></tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" id="delete_row" class="btn btn-sm btn-danger btn-lg m-t-15 waves-effect">
                            <i class="material-icons">remove</i>
                            <span></span>
                        </button>
                        <button type="button" id="add_row" class="btn btn-sm btn-primary btn-lg m-t-15 waves-effect right">
                            <i class="material-icons">add</i>
                            <span></span>
                        </button>
                    </div>
                </div>
                <a href="{{route('admin.sr')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                    <i class="material-icons left">arrow_back</i>
                    <span>BACK</span>
                </a>

                <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                    <i class="material-icons">save</i>
                    <span>SAVE</span>
                </button>
            </div>

        </form>
    </div>

@endsection


@push('scripts')
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                $("#addr"+(i-1)).html('');
                i--;
                }
                calc();
            });
        });
    </script>


    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>

@endpush
