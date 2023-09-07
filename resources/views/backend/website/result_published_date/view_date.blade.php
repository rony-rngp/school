@extends('layouts.backend.app')

@section('title', 'Published Date')

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
                        <h3 class="float-left">Result Published Date</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Published Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $sl = 1;
                            @endphp
                            @foreach($published_date as $row)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $row->published_date }}</td>
                                <td>
                                    <a href="{{ route('edit.date', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
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

