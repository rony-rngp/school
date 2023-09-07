@extends('layouts.backend.app')

@section('title', 'Details Employee Salary')

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
                            <h3 class="float-left">Details Employee Salary</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('account.view.employee.salary') }}"><i class="fa fa-list-alt"></i>  Employee Salary List</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID NO</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->user->id_no }} </td>
                                        <td>{{ $row->user->name }} </td>
                                        <td>{{ $row->amount }} </td>
                                        <td>{{ date('M-Y', strtotime($row->date)) }} </td>
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

