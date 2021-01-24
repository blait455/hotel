@extends('backend.layouts.app')

@section('title', 'Create Food type')

@push('styles')


@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.drink-categories.index')}}" class="waves-effect waves-light btn btn-danger right m-b-15">
            <i class="material-icons left">arrow_back</i>
            <span>BACK</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>CREATE DRINK CATEGORY</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.drink-categories.store')}}" method="POST">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control">
                                <label class="form-label">Type</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                                <label class="form-label">Description</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')



@endpush