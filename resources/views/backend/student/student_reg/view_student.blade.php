@extends('layouts.backend.app')

@section('title', 'Student List')

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
                            <h3 class="float-left">Student List</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('add.student') }}"><i class="fa fa-plus-square"></i> Add Student</a></p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('year.class.wise.student') }}" method="GET" id="quickForms">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="year_id">Year <font style="color: red">*</font></label>
                                        <select name="year_id" id="year_id" class="form-control">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yr)
                                                <option {{ @$year_id == $yr->id ? 'selected' : '' }} value="{{ $yr->id }}">{{ $yr->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('year_id') ? $errors->first('year_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="class_id">Class <font style="color: red">*</font></label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($class as $cls)
                                                <option {{ @$class_id == $cls->id ? 'selected' : '' }} value="{{ $cls->id }}">{{ $cls->name }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red">{{ $errors->has('class_id') ? $errors->first('class_id') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-outline-info" name="search" style="margin-top: 30px">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            @if(!@$search)
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>ID NO</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        @if(Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @foreach($student_reg as $row)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $row->user->id_no }} </td>
                                            <td>{{ $row->roll }}</td>
                                            <td>{{ $row->year->name }} </td>
                                            <td>{{ $row->class->name }} </td>
                                            @if(Auth::user()->role == 'Admin')
                                                <td>{{ $row->user->code }} </td>
                                            @endif
                                            <td><img height="60" width="80" src="{{ $row->user->image ? URL($row->user->image) : asset('public/backend/upload/no_image.png') }}"></td>
                                            <td>
                                                <a href="{{ route('edit.student', $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('promotion.student', $row->id) }}"  title="Promotion" class="btn btn-success btn-sm"> <i class="fa fa-check-circle"></i></a>
                                                <a href="{{ route('details.student', $row->id) }}" target="_blank" title="Details" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i></a>
                                                {{--<a href="{{ route('destroy.student', $row->id) }}" title="Delete" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt"></i></a>--}}

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>ID NO</th>
                                        <th>Roll</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        @if(Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                        @endif
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $sl = 1;
                                    @endphp
                                    @foreach($student_reg as $row)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $row->user->name }}</td>
                                            <td>{{ $row->user->id_no }} </td>
                                            <td>{{ $row->roll }}</td>
                                            <td>{{ $row->year->name }} </td>
                                            <td>{{ $row->class->name }} </td>
                                            @if(Auth::user()->role == 'Admin')
                                                <td>{{ $row->user->code }} </td>
                                            @endif
                                            <td><img height="60" width="80" src="{{ $row->user->image ? URL($row->user->image) : asset('public/backend/upload/no_image.png') }}"></td>
                                            <td>
                                                <a href="{{ route('edit.student',  $row->id) }}"  title="Edit" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                                <a href="{{ route('promotion.student', $row->id) }}"  title="Promotion" class="btn btn-success btn-sm"> <i class="fa fa-check-circle"></i></a>
                                                <a href="{{ route('details.student', $row->id) }}" target="_blank" title="Details" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i></a>
                                                {{--<a href="{{ route('destroy.student', $row->id) }}" title="Delete" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt"></i></a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif

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

