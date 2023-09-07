@extends('layouts.backend.app')

@section('title', 'Edit Employee')

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
                            <h3 class="float-left">Edit Employee</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.employee') }}"><i class="fa fa-list-alt"></i>  Employee List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('update.employee', $employee->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Employee Name <font style="color: red">*</font></label>
                                        <input type="text" name="name" id="name" value="{{ $employee->name }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="fname">Father's Name <font style="color: red">*</font></label>
                                        <input type="text" name="fname" id="fname" value="{{ $employee->fname }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('fname') ? $errors->first('fname') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mname">Mother's Name <font style="color: red">*</font></label>
                                        <input type="text" name="mname" id="mname" value="{{ $employee->mname }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('mname') ? $errors->first('mname') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile Number <font style="color: red">*</font></label>
                                        <input type="text" name="mobile" id="mobile" value="{{ $employee->mobile }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address">Address <font style="color: red">*</font></label>
                                        <input type="text" name="address" id="address" value="{{ $employee->address }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender <font style="color: red">*</font></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option {{ $employee->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ $employee->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="religion">Religion <font style="color: red">*</font></label>
                                        <select name="religion" id="religion" class="form-control">
                                            <option value="">Select Religion</option>
                                            <option {{ $employee->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                                            <option {{ $employee->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                                            <option {{ $employee->religion == 'Other' ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('religion') ? $errors->first('religion') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="dob">Date of Birth <font style="color: red">*</font></label>
                                        <input type="text" name="dob" id="dob" value="{{ $employee->dob }}" placeholder="dd/mm/yyy" class="form-control" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="designation_id">Designation <font style="color: red">*</font></label>
                                        <select name="designation_id" id="designation_id" class="form-control select2bs4">
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $designation)
                                                <option {{ $employee->designation_id == $designation->id ? 'selected' : '' }} value="{{ $designation->id }}">{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('designation_id') ? $errors->first('designation_id') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <img id="showImage" src="{{ $employee->image ? url($employee->image) : asset('public/backend/upload/no_image.png') }}" height="100" width="110">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="about">About</label>
                                        <textarea type="text" rows="4" name="about" id="about" class="form-control">{{ $employee->about }}</textarea>
                                        <span style="color:red">{{ $errors->has('about') ? $errors->first('about') : '' }}</span>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    "name": {
                        required: true,
                    },
                    "fname": {
                        required: true,
                    },
                    "mname": {
                        required: true,

                    },
                    "mobile": {
                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    "salary": {
                        required: true,
                        number: true
                    },
                    "address": {
                        required: true,
                    },
                    "gender": {
                        required: true,
                    },
                    "religion": {
                        required: true,
                    },
                    "dob": {
                        required: true,
                    },
                    "designation_id": {
                        required: true,
                    },
                    "join_date": {
                        required: true,
                    },

                    "about": {
                        minlength: 50,
                    },

                },

                messages: {

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

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#dob').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy'
        });
    </script>

    <script>
        $('#join_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy'
        });
    </script>
@endpush

