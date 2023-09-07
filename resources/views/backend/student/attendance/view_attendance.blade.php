@extends('layouts.backend.app')

@section('title', 'Student Attendance')

@push('css')

@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Student Attendance</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.student.attendance') }}"><i class="fa fa-plus-square"></i> Add Attendance</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Class</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($student_attendance as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->date }} </td>
                                        <td>{{ $row->class->name }} </td>
                                        <td>{{ $row->year->name }} </td>
                                        <td>
                                            <a href="{{ url('student/edit/attendance/'. $row->date . '/' . $row->class_id . '/' .$row->year_id)}}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <a href="{{ url('student/details/attendance/'. $row->date . '/' . $row->class_id . '/' .$row->year_id)}}" title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('css')

@endpush
