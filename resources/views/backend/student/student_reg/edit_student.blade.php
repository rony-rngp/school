@extends('layouts.backend.app')

@section('title', 'Edit Student')

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
                            <h3 class="float-left">Edit Student</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.student') }}"><i class="fa fa-list-alt"></i>  Student List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.student',$edit_data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Student Name <font style="color: red">*</font></label>
                                        <input type="text" name="name" id="name" value="{{ $edit_data->user->name }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="fname">Father's Name <font style="color: red">*</font></label>
                                        <input type="text" name="fname" id="fname" value="{{ $edit_data->user->fname }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('fname') ? $errors->first('fname') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mname">Mother's Name <font style="color: red">*</font></label>
                                        <input type="text" name="mname" id="mname" value="{{ $edit_data->user->mname }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('mname') ? $errors->first('mname') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Mobile Number <font style="color: red">*</font></label>
                                        <input type="text" name="mobile" id="mobile" value="{{ $edit_data->user->mobile }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="address">Address <font style="color: red">*</font></label>
                                        <input type="text" name="address" id="address" value="{{ $edit_data->user->address }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="gender">Gender <font style="color: red">*</font></label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option {{ $edit_data->user->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ $edit_data->user->gender == 'Female' ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('gender') ? $errors->first('gender') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="religion">Religion <font style="color: red">*</font></label>
                                        <select name="religion" id="religion" class="form-control">
                                            <option value="">Select Religion</option>
                                            <option {{ $edit_data->user->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                                            <option {{ $edit_data->user->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                                            <option {{ $edit_data->user->religion == 'Other' ? 'selected' : '' }} value="Other">Other</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('religion') ? $errors->first('religion') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="dob">Date of Birth <font style="color: red">*</font></label>
                                        <input type="date" name="dob" id="dob" value="{{ $edit_data->user->dob }}" class="form-control" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('dob') ? $errors->first('dob') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="discount">Discount <font style="color: red">*</font></label>
                                        <input type="text" name="discount" id="discount" value="{{ $edit_data->discount_student->discount }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('discount') ? $errors->first('discount') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="year_id">Year <font style="color: red">*</font></label>
                                        <select name="year_id" id="year_id" class="form-control select2bs4">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yr)
                                                <option {{ $edit_data->year_id == $yr->id ? 'selected' : '' }} value="{{ $yr->id }}">{{ $yr->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="class_id">Class <font style="color: red">*</font></label>
                                        <select name="class_id" id="class_id" class="form-control select2bs4">
                                            <option value="">Select Class</option>
                                            @foreach($class as $cls)
                                                <option {{ $edit_data->class_id == $cls->id ? 'selected' : '' }} value="{{ $cls->id }}">{{ $cls->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile">Student Attendance </label>
                                        <input type="number" name="student_attendance" id="student_attendance" value="{{ $edit_data->user->student_attendance }}" class="form-control">
                                        <span style="color:red">{{ $errors->has('student_attendance') ? $errors->first('student_attendance') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span style="color:red">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-2" style="float: right">
                                        <img id="showImage" src="{{ $edit_data->user->image ? url($edit_data->user->image) : asset('public/backend/upload/no_image.png') }}" height="100" width="110">
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
    <script>
        $(function () {
            $('#quickForm').validate({
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
                        minlength:11,
                        maxlength: 11,

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
                    "discount": {
                        required: true,
                        number: true
                    },
                    "year_id": {
                        required: true,
                    },
                    "class_id": {
                        required: true,
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
@endpush

