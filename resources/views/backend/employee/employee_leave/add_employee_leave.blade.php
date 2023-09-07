@extends('layouts.backend.app')

@section('title', 'Add Employee Leave')

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
                            <h3 class="float-left">Add Employee Leave</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.employee.leave') }}"> <i class="fa fa-list-alt"></i> Employee Leave List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('store.employee.leave') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="employee_id">Employee <font style="color: red">*</font></label>
                                        <select name="employee_id" id="employee_id" class="form-control select2bs4">
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('employee_id') ? $errors->first('employee_id') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="start_date">Start Date</label>
                                        <input type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control" placeholder="Start Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('start_date') ? $errors->first('start_date') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="end_date">End Date</label>
                                        <input type="text" name="end_date" id="end_date" value="{{ old('end_date') }}" class="form-control" placeholder="End Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('end_date') ? $errors->first('end_date') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="leave_purposes_id">Leave Purpose <font style="color: red">*</font></label>
                                        <select name="leave_purposes_id" id="leave_purposes_id" class="form-control select2bs4">
                                            <option value="">Select Employee</option>
                                            @foreach($leave_purpose as $purpose)
                                                <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                            @endforeach
                                            <option value="0">New Purpose</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('leave_purposes_id') ? $errors->first('leave_purposes_id') : '' }}</span>
                                        <div class="show_field" style="display: none">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Write Purpose">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
        $(document).ready(function () {
            $(document).on('change', '#leave_purposes_id', function () {
                var leave_purposes_id = $(this).val();
                if(leave_purposes_id == '0'){
                    $('.show_field').show();
                }else{
                    $('.show_field').hide();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    employee_id: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                    leave_purposes_id: {
                        required: true,
                    },
                    name: {
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

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#start_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>

    <script>
        $('#end_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush

