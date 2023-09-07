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
                            <h3 class="float-left">Employee Salary List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('account.add.employee.salary') }}"><i class="fa fa-plus-circle"></i> Add/Edit Employee Salary</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ date('M-Y', strtotime($row->date)) }} </td>
                                        <td>
                                            <a href="{{ route('details.employee.salary', $row->date) }}"  title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
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

