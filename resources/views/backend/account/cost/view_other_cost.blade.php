@extends('layouts.backend.app')

@section('title', 'Others Cost')

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
                            <h3 class="float-left">All Costs</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.other.cost') }}"><i class="fa fa-plus-square"></i> Add Cost</a></p>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Dete</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Image</th>
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
                                        <td>{{ $row->date }}</td>
                                        <td>{{ $row->amount }} </td>
                                        <td>{{ $row->description }}</td>
                                        <td><img height="60" width="80" src="{{ $row->image ? url($row->image) : asset('public/backend/upload/no_image.png') }}"></td>
                                        <td>
                                            <a href="{{ route('edit.other.cost', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                            <!--Delete Data-->
                                            <button class="btn btn-sm btn-danger waves-effect" id="delete" type="button" onclick="deleteData({{ $row->id }})">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $row->id }}" action="{{ route('destroy.other.cost', $row->id) }}" method="post" style="display: none">
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

