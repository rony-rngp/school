@extends('layouts.backend.app')

@section('title', 'Admission List')

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
                            <h3 class="float-left">Admission List</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Class</th>
                                    <th>Session</th>
                                    <th>Transaction</th>
                                    <th>Reference</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($admission as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->mobile }}</td>
                                        <td>{{ $row->class->name }}</td>
                                        <td>{{ $row->year->name }}</td>
                                        <td>{{ $row->transaction }}</td>
                                        <td>{{ $row->reference }}</td>
                                        <td><img height="60" width="80" src="{{ $row->image ? url($row->image) : asset('public/backend/upload/avatar.png') }}"></td>
                                        <td>
                                            <a href="{{ route('details.admission', $row->id) }}"  title="Details" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i></a>
                                             <!--Delete Data-->
                                             <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $row->id }})">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $row->id }}" action="{{ route('destroy.admission', $row->id) }}" method="post" style="display: none">
                                                @csrf
                                                @method('post')
                                            </form>
                                            <!--End Delete Data-->
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

