@extends('layouts.backend.app')

@section('title', 'Edit Marks')

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
                            <h3 class="float-left">Edit Marks</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.marks') }}" method="POST" id="quickForms">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="year_id">Year <font style="color: red">*</font></label>
                                        <select name="year_id" id="year_id" class="form-control select2bs4">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yr)
                                                <option value="{{ $yr->id }}">{{ $yr->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="class_id">Class <font style="color: red">*</font></label>
                                        <select name="class_id" id="class_id" class="form-control select2bs4">
                                            <option value="">Select Class</option>
                                            @foreach($class as $cls)
                                                <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="assign_subject_id">Subject <font style="color: red">*</font></label>
                                        <select name="assign_subject_id" id="assign_subject_id" class="form-control select2bs4">
                                            <option value="">Select Subject</option>

                                        </select>
                                        <span style="color:red">{{ $errors->has('assign_subject_id') ? $errors->first('assign_subject_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exam_type_id">Exam <font style="color: red">*</font></label>
                                        <select name="exam_type_id" id="exam_type_id" class="form-control select2bs4">
                                            <option value="">Select Exam</option>
                                            @foreach($exam_types as $exam_type)
                                                <option value="{{ $exam_type->id }}">{{ $exam_type->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('exam_type_id') ? $errors->first('exam_type_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <a id="search" class="btn btn-outline-info" name="search">Search</a>
                                    </div>
                                </div><br>
                                <div class="row d-none" id="marks_entry">
                                    <div class="col-md-12">

                                        <div style="display: flex;justify-content: end">
                                            <h4 style="margin-right: 10px">Full Marks : <span class="full_mark"></span>,</h4>
                                            <h4 >Pass Marks : <span class="pass_mark"></span></h4>
                                        </div>

                                        <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Gender</th>
                                                <th>Marks</th>
                                                <th>Other Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody id="marks_entry_tr">
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-success">Update Marks</button>
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
        $(document).on('change', '#class_id', function () {
            var class_id = $('#class_id').val();
            $.ajax({
                url: "{{ route('get_subject') }}",
                type: "GET",
                data: {class_id : class_id},

                success: function (data) {
                    var html = '<option value="">Select Subject</option>';
                    $.each(data, function (key, v) {
                        html+= '<option value="'+v.id+'">'+v.subject.name+'</option>';
                    });
                    $('#assign_subject_id').html(html);
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '#search', function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();

            if(year_id == ""){
                toastr.error("Year is Required");
                return false;
            }
            if(class_id == ""){
                toastr.error("Class is Required");
                return false;
            }
            if(assign_subject_id == ""){
                toastr.error("Subject is Required");
                return false;
            }
            if(exam_type_id == ""){
                toastr.error("Exam is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.student.marks') }}",
                type : "GET",
                data : {'year_id' : year_id, 'class_id' : class_id, 'assign_subject_id' : assign_subject_id, 'exam_type_id': exam_type_id},
                success: function (data) {
                    $('#marks_entry').removeClass('d-none');
                    $(".full_mark").text(data.subject_info.full_mark);
                    $(".pass_mark").text(data.subject_info.pass_mark);
                    var html = '';
                    $.each(data.student_marks, function (key , v) {
                        html +=
                            '<tr>'+
                            '<td>'+v.user.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.user.id_no+'"></td>'+
                            '<td>'+v.user.name+'</td>'+
                            '<td>'+v.user.fname+'</td>'+
                            '<td>'+v.user.gender+'</td>'+
                            '<td><input type="text" class="form-control form-control-sm" value="'+v.marks+'" name="marks[]"></td>'+
                            '<td><input type="text" class="form-control form-control-sm" value="'+v.other_marks+'" name="other_marks[]"></td>'+
                            '</tr>';
                    });
                    html = $('#marks_entry_tr').html(html);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    "year_id": {
                        required: true,
                    },
                    "class_id": {
                        required: true,
                    },
                    "marks[]": {
                        required: true,
                        number: true

                    },
                    "other_marks[]": {
                        required: true,
                        number: true

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

