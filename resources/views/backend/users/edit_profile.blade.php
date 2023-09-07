@extends('layouts.backend.app')

@section('title', 'Edit Profile')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Edit Profile</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.profile', $edit_user->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $edit_user->name }}" class="form-control" placeholder="Name">
                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="email">E-Mail</label>
                                        <input type="email" name="email" id="email" value="{{ $edit_user->email }}" class="form-control" placeholder="E-Mail">
                                        <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" value="{{ $edit_user->mobile }}" class="form-control" placeholder="Mobile Number">
                                        <span style="color:red">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" value="{{ $edit_user->address }}" class="form-control" placeholder="Address">
                                        <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="gender">gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option {{ $edit_user->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ $edit_user->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('user_type') ? 'The user role field is required.' : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <img id="showImage" src="{{ $edit_user->image ? URL($edit_user->image) : asset('public/backend/upload/no_image.png') }}" height="100" width="110">
                                    </div>

                                    <div class="form-group col-md-10" style="margin-top: 30px">
                                        <button type="submit"  class="btn btn-primary">Update Profile</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')
    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength:30,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    mobile: {
                        number: true,
                        minlength: 11,
                        maxlength: 11,
                    },

                    address: {
                        minlength: 4,
                    },

                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush

