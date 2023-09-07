@extends('layouts.backend.app')

@section('title', 'Employee Leave List')

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
                            <h3 class="float-left">Employee Leave List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.employee.leave') }}"><i class="fa fa-plus-square"></i> Add Employee Leave</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>ID NO</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($employee_leave as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->user->id_no }}</td>
                                        <td>{{ $row->purpose->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->start_date)) }} to {{ date('d-m-Y', strtotime($row->end_date)) }}</td>
                                        <td>
                                            <a href="{{ route('edit.employee.leave', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                        </td>
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

@endpush

