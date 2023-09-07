@extends('layouts.backend.app')

@section('title', 'Details Assign Subject')

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
                            <h3 class="float-left">Details Fee Amount ( <i class="text-danger">{{ $details[0]->class->name }} : </i> )</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Subject</th>
                                    <th>Full Mark</th>
                                    <th>Pass Mark</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($details as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->subject->name }} </td>
                                        <td>{{ $row->full_mark }} </td>
                                        <td>{{ $row->pass_mark }} </td>
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

