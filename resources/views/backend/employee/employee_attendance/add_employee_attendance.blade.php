@extends('layouts.backend.app')

@section('title', 'Add Employee Attendance')

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
                            <h3 class="float-left">Add Employee Attendance</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.employee.attendance') }}"><i class="fa fa-list-alt"></i>  Employee Attendance List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('store.employee.attendance') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date">Date <font style="color: red">*</font></label>
                                        <input type="text" name="date" readonly {{--id="date"--}} class="form-control" value="{{ date('Y-m-d', strtotime(\Carbon\Carbon::today())) }}" placeholder="Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                    </div>
                                </div>

                                <table class=" table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">SL</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Employee Name</th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all" style="display: table-cell;background-color: #114190">Present</th>
                                        <th class="text-center btn leave_all" style="display: table-cell;background-color: #114190">Leave</th>
                                        <th class="text-center btn absent_all" style="display: table-cell;background-color: #114190">Absent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}" class="employee_id">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
                                                    <input type="radio" class="present" id="present{{$key}}" name="attend_status{{ $key }}" value="Present" checked="checked">
                                                    <label for="present{{$key}}">Present</label>

                                                    <input type="radio" class="leave" id="leave{{$key}}" name="attend_status{{ $key }}" value="Leave"
                                                    @foreach($employee_leave as $leave)
                                                        {{ $leave->employee_id == $employee->id ? 'checked' : '' }}
                                                    @endforeach
                                                    >
                                                    <label for="leave{{$key}}">Leave</label>

                                                    <input type="radio" class="absent" id="absent{{$key}}" name="attend_status{{ $key }}" value="Absent">
                                                    <label for="absent{{$key}}">Absent</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table><br>

                                <button type="submit" class="btn btn-primary">Take Attendance</button>
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
        $(document).on('click', '.present_all', function () {
            $("input[value=Present]").prop('checked', true);
        });
        $(document).on('click', '.leave_all', function () {
            $("input[value=Leave]").prop('checked', true);
        });
        $(document).on('click', '.absent_all', function () {
            $("input[value=Absent]").prop('checked', true);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    "date": {
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
        $('#date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endpush

