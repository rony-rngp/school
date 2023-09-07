@extends('layouts.backend.app')

@section('title', 'Details Student Attendance')

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
                            <h3 class="float-left">Details Student Attendance</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.student.attendance') }}"><i class="fa fa-list-alt"></i>  Student Attendance List</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID NO</th>
                                    <th>Name</th>
                                    <th>Roll</th>
                                    <th>Class</th>
                                    <th>Attend Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($details as $row)
                                    <tr>
                                        <td><b><i>{{ $sl++ }}</i></b></td>
                                        <td><b><i>{{ $row->user->id_no }}</i></b></td>
                                        <td><b><i>{{ $row->user->name }}</i></b></td>
                                        <td><b><i>{{ $row->roll }}</i></b></td>
                                        <td><b><i>{{ $row->class->name }}</i></b></td>
                                        <td><b><i>{{ $row->attend_status }}</i></b></td>
                                        <td><b><i>{{ date('d-m-Y', strtotime($row->date)) }}</i></b></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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

