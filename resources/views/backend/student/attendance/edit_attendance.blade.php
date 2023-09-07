@extends('layouts.backend.app')

@section('title', 'Edit Student Attendance')

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
                            <h3 class="float-left">Edit Student Attendance</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.student.attendance') }}"><i class="fa fa-list-alt"></i>  Student Attendance List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('update.student.attendance', $edit_data[0]->date) }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="date">Date <font style="color: red">*</font></label>
                                        <input type="text" name="date"  class="form-control" value="{{ $edit_data[0]->date }}" readonly placeholder="Date" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                                    </div>
                                </div>

                                <table class=" table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">SL</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">ID NO</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Name</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Class</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Roll</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Session</th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all" style="display: table-cell;background-color: #114190">Present</th>
                                        <th class="text-center btn absent_all" style="display: table-cell;background-color: #114190">Absent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($edit_data as $key => $row)
                                        <tr class="text-center">
                                            <input type="hidden" name="student_id[]" value="{{ $row->student_id }}" class="student_id">
                                            <input type="hidden" name="roll[]" value="{{ $row->roll }}" class="student_id">
                                            <input type="hidden" name="year_id" value="{{ $row->year_id }}" class="student_id">
                                            <input type="hidden" name="class_id" value="{{ $row->class_id }}" class="student_id">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row->user->id_no }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $row->class->name }}</td>
                                            <td>{{ $row->roll }}</td>
                                            <td>{{ $row->year->name }}</td>
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
                                                    <input type="radio" class="present" id="present{{$key}}" name="attend_status{{ $key }}" value="Present" {{ $row->attend_status == 'Present' ? 'checked' : '' }}>
                                                    <label for="present{{$key}}">Present</label>

                                                    <input type="radio" class="absent" id="absent{{$key}}" name="attend_status{{ $key }}" value="Absent" {{ $row->attend_status == 'Absent' ? 'checked' : '' }}>
                                                    <label for="absent{{$key}}">Absent</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table><br>

                                <button type="submit" class="btn btn-primary">Update Attendance</button>
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

