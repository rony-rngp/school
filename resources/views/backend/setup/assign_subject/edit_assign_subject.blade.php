@extends('layouts.backend.app')

@section('title', 'Edit Assign Subject')

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
                            <h3 class="float-left">Add Assign Subject</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.assign.subject') }}"><i class="fa fa-list-alt"></i>  Fee Amount List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.assign.subject', $edit_data[0]->class_id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="class_id">Class</label>
                                            <select name="class_id" id="class_id" disabled class="form-control select2bs4" style="width: 100%;">
                                                <option value="">Select Class</option>
                                                @foreach($classes as $class)
                                                    <option {{ $edit_data[0]->class_id == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @foreach($edit_data as $data)
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="subject_id">Subject</label>
                                                <select name="subject_id[]" id="subject_id" class="form-control select2bs4" style="width: 100%;">
                                                    <option value="">Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option {{ $data->subject_id == $subject->id ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="full_mark">Full Mark</label>
                                                <input type="text" name="full_mark[]" id="full_mark" value="{{ $data->full_mark }}" class="form-control" placeholder="Full Mark">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="pass_mark">Pass Mark</label>
                                                <input type="text" name="pass_mark[]" id="pass_mark" value="{{ $data->pass_mark }}" class="form-control" placeholder="Pass Mark">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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

    <script>
        $(function () {
            $('#quickForm').validate({
                ignore: [],
                rules: {
                    "class_id": {
                        required: true,
                    },
                    "subject_id[]": {
                        required: true,
                    },
                    "full_mark[]": {
                        required: true,
                        number: true
                    },
                    "pass_mark[]": {
                        required: true,
                        number: true
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

