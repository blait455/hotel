@extends('backend.layouts.app')

@section('title', 'Edit Testimonial')

@push('styles')


@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.services.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT SERVICE</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.services.update',$service->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control" value="{{ $service->title }}">
                                    <label class="form-label">Service Title</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <textarea name="description" rows="4" class="form-control no-resize">{{ $service->description }}</textarea>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="file" name="image" id="slider-image-input-edit" style="display:none;">
                                <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="slider-image-btn-edit">
                                    <i class="material-icons">image</i>
                                    <span>UPLOAD IMAGE</span>
                                </button>
                            </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">update</i>
                            <span>Update</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
<script>
    function showImage(fileInput,imgID){
        if (fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $(imgID).attr('src',e.target.result);
                $(imgID).attr('alt',fileInput.files[0].name);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    $('#slider-image-btn-edit').on('click', function(){
        $('#slider-image-input-edit').click();
    });
    $('#slider-image-input-edit').on('change', function(){
        showImage(this, '#slider-imgsrc-edit');
    });

</script>
@endpush
