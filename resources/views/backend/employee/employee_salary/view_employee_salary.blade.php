@extends('layouts.backend.app')

@section('title', 'Employee Salary List')

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
                            <h3 class="float-left">Employee Salary</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Mobile</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($employee_salary as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td><i class="text-danger"><b>{{ $row->name }}</b></i></td>
                                        <td>{{ $row->id_no }} </td>
                                        <td>{{ $row->mobile }} </td>
                                        <td>{{ $row->join_date }} </td>
                                        <td><i class="text-danger"><b>{{ $row->salary }}</b></i></td>
                                        <td><img height="65" width="80" src="{{ $row->image ? url($row->image) : asset('public/backend/upload/avatar.png') }}"></td>
                                        <td>
                                            <a href="{{ route('increment.employee.salary', $row->id) }}"  title="Increment" class="btn btn-primary btn-sm"> <i class="fa fa-plus-circle"></i></a>
                                            <a href="{{ route('details.increment.employee.salary', $row->id) }}" title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
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

