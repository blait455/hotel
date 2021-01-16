{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{ $user->name }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                @foreach ($roles as $role)
                                    <div>
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if ($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                        <label>{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('backend.layouts.app')

@section('title', 'Edit Post')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.users.update', $user)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit {{ $user->name }}</h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">Name</label><br><br>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">User Name</label><br><br>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">Email</label><br><br>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <label class="form-label">Bio</label><br><br>
                                <textarea name="about" rows="4" id="tinymce">{{ $user->about }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>MEDIA</h2>
                    </div>
                    <div class="body">
                        <div class="text-center">
                            <img src="{{Storage::url('users/'.$user->image)}}" alt="{{ $user->name }}" width="200" height="200" class="img-thumbnail">
                        </div>
                        <div class="form-group text-center">
                            <label for="form-label">Profile Image</label>
                            <input type="file" name="image">
                        </div>    

                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                                <label for="roles">Select Role</label>
                                <select name="roles[]" class="form-control show-tick" id="roles" multiple data-live-search="true">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <a href="{{route('admin.users.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                            <i class="material-icons left">arrow_back</i>
                            <span>BACK</span>
                        </a>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>UPDATE</span>
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
        @php
            $selectedroles = json_encode($selectedrole);
        @endphp

        $('#roles').selectpicker();
        $('#roles').selectpicker('val',{{$selectedroles}});
        
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
    </script>

@endpush

