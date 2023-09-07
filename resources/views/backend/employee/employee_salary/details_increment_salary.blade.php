@extends('layouts.backend.app')

@section('title', 'Salary Details')

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
                            <h3 class="float-left"> Increment Salary Details</h3>
                        </div>
                        <br>
                        <h4 class="text-danger" style="text-align: center"><strong><i>Employee Name : {{ $details->name }}, ID NO : {{ $details->id_no }}</i></strong></h4>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Previous Salary</th>
                                    <th>Increment Salary</th>
                                    <th>Present Salary</th>
                                    <th>Effected Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($salary as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->previous_salary }}</td>
                                        <td>{{ $row->increment_salary }}</td>
                                        <td>{{ $row->present_salary }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->effected_date)) }} </td>
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

