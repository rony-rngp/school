@extends('layouts.backend.app')

@section('title', 'Fee Amount List')

@push('css')

@endpush

@section('content')

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="float-left">Fee Amount List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.fee.amount') }}"><i class="fa fa-plus-square"></i> Add Fee Amount</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($free_ammount as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->fee_category->name }}</td>
                                        <td>
                                            <a href="{{ route('details.fee.amount', $row->fee_category_id) }}"  title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>

                                            <a href="{{ route('edit.fee.amount', $row->fee_category_id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
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

