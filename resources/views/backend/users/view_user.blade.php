@extends('layouts.backend.app')

@section('title', 'Users')

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
                            <h3 class="float-left">All Users</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.user') }}"><i class="fa fa-plus-square"></i> Add User</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach($users as $row)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td>{{ $row->name }} </td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->code ? $row->code : 'Null' }}</td>
                                        <td>
                                            <a href="{{ route('edit.user', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            @if($row->role != 'Admin')
                                                <!--Delete Data-->
                                                <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $row->id }})">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                                <form id="delete-form-{{ $row->id }}" action="{{ route('destroy.user', $row->id) }}" method="post" style="display: none">
                                                    @csrf
                                                    @method('post')
                                                </form>
                                                <!--End Delete Data-->
                                            @endif
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

