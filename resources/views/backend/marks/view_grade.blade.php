@extends('layouts.backend.app')

@section('title', 'Grade List')

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
                            <h3 class="float-left">Grade Points List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.grade') }}"><i class="fa fa-plus-square"></i> Add Grade Points</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Grade Name</th>
                                    <th>Grade Point</th>
                                    <th>Start Marks</th>
                                    <th>End Marks</th>
                                    <th>Point Range</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($grade as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->grade_name }} </td>
                                        <td>{{ number_format((float)$row->grade_point, '2') }} </td>
                                        <td>{{ $row->start_marks }} </td>
                                        <td>{{ $row->end_marks }} </td>
                                        <td>{{ number_format((float)$row->start_point, '2') }} - {{ number_format((float)$row->end_point, '2') }} </td>
                                        <td>{{ $row->remarks }} </td>
                                        <td>
                                            <a href="{{ route('edit.grade', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
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

