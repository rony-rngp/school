@extends('layouts.backend.app')

@section('title', 'Add Grade')

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
                            <h3 class="float-left">Add Grade Points</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.grade') }}"><i class="fa fa-list-alt"></i>  Grade List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('store.grade') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="grade_name">Grade Name</label>
                                        <input type="text" name="grade_name" id="grade_name" value="{{ old('grade_name') }}" class="form-control" placeholder="Grade Name">
                                        <span style="color:red">{{ $errors->has('grade_name') ? $errors->first('grade_name') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="grade_point">Grade Point</label>
                                        <input type="text" name="grade_point" id="grade_point" value="{{ old('grade_point') }}" class="form-control" placeholder="Grade Point">
                                        <span style="color:red">{{ $errors->has('grade_point') ? $errors->first('grade_point') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="start_marks">Start Marks</label>
                                        <input type="text" name="start_marks" id="start_marks" value="{{ old('start_marks') }}" class="form-control" placeholder="Start Marks">
                                        <span style="color:red">{{ $errors->has('start_marks') ? $errors->first('start_marks') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="end_marks">End Marks</label>
                                        <input type="text" name="end_marks" id="end_marks" value="{{ old('end_marks') }}" class="form-control" placeholder="End Marks">
                                        <span style="color:red">{{ $errors->has('end_marks') ? $errors->first('end_marks') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="start_point">Start Point</label>
                                        <input type="text" name="start_point" id="start_point" value="{{ old('start_point') }}" class="form-control" placeholder="Start Point">
                                        <span style="color:red">{{ $errors->has('start_point') ? $errors->first('start_point') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="end_point">End Point</label>
                                        <input type="text" name="end_point" id="end_point" value="{{ old('end_point') }}" class="form-control" placeholder="End Point">
                                        <span style="color:red">{{ $errors->has('end_point') ? $errors->first('end_point') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="remarks">Remarks</label>
                                        <input type="text" name="remarks" id="remarks" value="{{ old('remarks') }}" class="form-control" placeholder="Remarks">
                                        <span style="color:red">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#quickForms").validate({
                rules: {
                    grade_name: {
                        required: true,
                    },
                    grade_point: {
                        required: true,
                        number: true,
                        maxlength: 4
                    },
                    start_marks: {
                        required: true,
                        number: true
                    },
                    end_marks: {
                        required: true,
                        number: true
                    },
                    start_point: {
                        required: true,
                        number: true,
                        maxlength: 4
                    },
                    end_point: {
                        required: true,
                        number: true,
                        maxlength: 4
                    },
                    remarks: {
                        required: true,
                    },

                },
                messages: {

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>
@endpush

