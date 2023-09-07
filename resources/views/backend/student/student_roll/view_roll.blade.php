@extends('layouts.backend.app')

@section('title', 'Student Roll')

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
                            <h3 class="float-left">Roll Generate</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.student.roll') }}" method="POST" id="quickForms">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="year_id">Year <font style="color: red">*</font></label>
                                        <select name="year_id" id="year_id" class="form-control select2bs4">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yr)
                                                <option value="{{ $yr->id }}">{{ $yr->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="class_id">Class <font style="color: red">*</font></label>
                                        <select name="class_id" id="class_id" class="form-control select2bs4">
                                            <option value="">Select Class</option>
                                            @foreach($class as $cls)
                                                <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a id="search" class="btn btn-outline-info" name="search" style="margin-top: 30px">Search</a>
                                    </div>
                                </div><br>
                                <div class="row d-none" id="roll_generate">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped dt-responsive" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Gender</th>
                                                <th>Roll No</th>
                                            </tr>
                                            </thead>
                                            <tbody id="roll_generate_tr">

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-success">Roll Generate</button>
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
        $(document).on('click', '#search', function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();

            if(year_id == ""){
                toastr.error("Year is Required");
                return false;
            }
            if(class_id == ""){
                toastr.error("Class is Required");
                return false;
            }

            $.ajax({
                url : "{{ route('get.student.roll') }}",
                type : "GET",
                data : {'year_id' : year_id, 'class_id' : class_id},
                success: function (data) {
                    $('#roll_generate').removeClass('d-none');
                    var html = '';
                    $.each(data, function (key , v) {
                        html +=
                            '<tr>'+
                            '<td>'+v.user.id_no+'<input type="hidden" name="id[]" value="'+v.id+'"></td>'+
                            '<td>'+v.user.name+'</td>'+
                            '<td>'+v.user.fname+'</td>'+
                            '<td>'+v.user.gender+'</td>'+
                            '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
                            '</tr>';
                    });
                    html = $('#roll_generate_tr').html(html);
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
                    "roll[]": {
                        required: true,
                        // number: true

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

