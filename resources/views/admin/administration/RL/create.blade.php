@extends('backend.layouts.app')

@section('title', 'Add Guest')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.rl.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>ADD GUEST</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            <label class="form-label">Name</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            <label class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                            <label class="form-label">Phone</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" value="{{old('address')}}" required>
                            <label class="form-label">Address</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="profession" value="{{old('profession')}}" required>
                            <label class="form-label">Profession</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="veh_reg_no" value="{{old('veh_reg_no')}}" required>
                            <label class="form-label">Vehicle Registration number</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="from" value="{{old('from')}}" required>
                            <label class="form-label">Arriving from</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="to" value="{{old('to')}}" required>
                            <label class="form-label">Departing to</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="purpose" value="{{old('purpose')}}" required>
                            <label class="form-label">Purpose of visit</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="nights" value="{{old('night')}}" required>
                            <label class="form-label">Number of nights</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="no_in_room" value="{{old('no_in_room')}}" required>
                            <label class="form-label">Number in room</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nationality" value="{{old('nationality')}}" required>
                            <label class="form-label">Nationality</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="emergency_name" value="{{old('emergency_name')}}" required>
                            <label class="form-label">Emergency contact name</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="emergency_phone" value="{{old('emergency_phone')}}" required>
                            <label class="form-label">Emergency contact phone</label>
                        </div>
                    </div>
                    <hr>
                    <hr>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="discount" value="{{old('discount')}}" required>
                            <label class="form-label">Discount</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="discounted_amount" value="{{old('discount_amount')}}" required>
                            <label class="form-label">Discounted amount</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="balance" value="{{old('balance')}}" required>
                            <label class="form-label">Balance</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="remarks" value="{{old('remarks')}}" required>
                            <label class="form-label">Remarks</label>
                        </div>
                    </div>

                    {{-- <hr>
                    <div class="form-group">
                        <label for="tinymce">Description</label>
                        <textarea name="description" id="tinymce">{{old('description')}}</textarea>
                    </div> --}}

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
                            <label>Guest Type</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="regular">Regular</option>
                                <option value="special">Special <small>(FUW or Palace)</small></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('room') ? 'focused error' : ''}}">
                            <label>Select Room</label>
                            <select name="room_id" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}&nbsp; &nbsp;<span>&#8358;{{ $room->price }}</span></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('floor') ? 'focused error' : ''}}">
                            <label>Status</label>
                            <select name="status" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="1">Checked in</option>
                                <option value="0">Booked</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('floor') ? 'focused error' : ''}}">
                            <label>Payment method</label>
                            <select name="payment_method" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank transfer</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('floor') ? 'focused error' : ''}}">
                            <label>Payment Type</label>
                            <select name="payment_type" class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="full">Full payment</option>
                                <option value="part">part payment</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <img src="" id="testimonial-imgsrc" class="img-responsive">
                        <input type="file" name="pop" id="testimonial-image-input" style="display:none;">
                        <button type="button" class="btn bg-grey btn-sm waves-effect m-t-15" id="testimonial-image-btn">
                            <i class="material-icons">image</i>
                            <span>UPLOAD PROOF OF PAYMENT</span>
                        </button>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="reference_code" name="rc" class="form-control">
                            <label class="form-label">POS reference code</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    {{-- BUTTON --}}
                    <a href="{{route('admin.guests.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            $("#input-id").fileinput();
        });

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
    <script>
        $(function(){
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
            $('#testimonial-image-btn').on('click', function(){
                $('#testimonial-image-input').click();
            });
            $('#testimonial-image-input').on('change', function(){
                showImage(this, '#testimonial-imgsrc');
            });
        })
    </script>


@endpush
