@extends('layouts.backend.app')

@section('title', 'Employee List')

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
                            <h3 class="float-left">Employee List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.employee') }}"><i class="fa fa-plus-square"></i> Add Employee</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($employees as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->name }} </td>
                                        <td>{{ $row->id_no }} </td>
                                        <td>{{ $row->mobile }} </td>
                                        <td>{{ $row->gender }} </td>
                                        <td>{{ $row->join_date }} </td>
                                        <td>{{ $row->salary }} </td>
                                        <td>{{ $row->code ? $row->code : 'Null' }}</td>
                                        <td><img height="65" width="80" src="{{ $row->image ? url($row->image) : asset('public/backend/upload/avatar.png') }}"></td>
                                        <td>
                                            <a href="{{ route('edit.employee', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <a href="{{ route('details.employee', $row->id) }}" target="_blank" title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
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

