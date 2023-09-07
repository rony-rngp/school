@extends('layouts.backend.app')

@section('title', 'Attendance Report')

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
                            <h3 class="float-left">Attendance Report</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('report.get.attendance') }}" target="_blank" method="GET" enctype="multipart/form-data" >
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="employee_id"> Employee <font style="color: red">*</font></label>
                                        <select name="employee_id" id="employee_id" class="form-control select2bs4">
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('employee_id') ? 'The Employee field is required.' : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="date">Month <font style="color: red">*</font></label>
                                        <input type="text" name="date" id="date" value="{{ old('date') }}" class="form-control" placeholder="Month" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-outline-info" style="margin-top: 31px">Submit</button>
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
                    employee_id: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },

                },
                messages: {

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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        var dp=$("#date").datepicker( {
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months"
        });

    </script>
@endpush

