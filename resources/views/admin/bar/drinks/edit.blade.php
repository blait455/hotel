@extends('backend.layouts.app')

@section('title', 'Edit Room')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.drinks.update',$drink->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT DRINK</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" value="{{$drink->name}}">
                            <label class="form-label">Drink Name</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" name="price" class="form-control" value="{{$drink->price}}" required>
                            <label class="form-label">Price &nbsp;<span>&#8358;</span></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="status" name="status" class="filled-in" value="1" {{ $drink->status ? 'checked' : '' }}/>
                        <label for="status">Status</label>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce">Description</label>
                        <textarea name="description" id="tinymce">{{$drink->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>SELECT</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Select Drink category</label>
                            <select name="category_id" class="form-control show-tick">
                                @foreach ($categories as $type)
                                    <option value="{{ $type->id }}" {{ $drink->type->id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="header bg-indigo">
                    <h2>FEATURED IMAGE</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        @if(Storage::disk('public')->exists('drink/'.$drink->image))
                            <img src="{{Storage::url('drink/'.$drink->image)}}" alt="{{$drink->name}}" class="img-responsive img-rounded"> <br>
                        @endif
                        <input type="file" name="image">
                    </div>

                    {{-- BUTTON --}}
                    <a href="{{route('admin.drinks.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>BACK</span>
                    </a>

                    <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>SAVE</span>
                    </button>

                </div>
            </div>

        </div>
        </form>
    </div>


@endsection


@push('scripts')

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DELETE PROPERTY GALLERY IMAGE
        $('.gallery-image-edit button').on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var image = $('#gallery-'+id+' img').attr('alt');
            $.post("{{route('admin.gallery-delete')}}",{id:id,image:image},function(data){
                if(data.msg == true){
                    $('#gallery-'+id).remove();
                }
            });
        });


        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {

                            $('<div class="gallery-image-edit" id="gallery-perview-'+i+'"><img src="'+event.target.result+'" height="106" width="173"/></div>').appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallaryimageupload').on('change', function() {
                imagesPreview(this, 'div#gallerybox');
            });
        });

        $(document).on('click','#galleryuploadbutton',function(e){
            e.preventDefault();
            $('#gallaryimageupload').click();
        })

    </script>

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

        $(function () {
            tinymce.init({
                selector: "textarea#tinymce-nearby",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: '',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>

@endpush