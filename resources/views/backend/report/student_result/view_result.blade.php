@extends('layouts.backend.app')

@section('title', 'Student Result')

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
                            <h3 class="float-left">Student Result</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('report.get.result') }}" target="_blank" method="GET">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="year_id">Year <font style="color: red">*</font></label>
                                        <select class="form-control select2bs4" name="year_id" id="year_id">
                                            <option  value="">Select Year</option>
                                            @foreach($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="class_id">Class <font style="color: red">*</font></label>
                                        <select class="form-control select2bs4" name="class_id" id="class_id">
                                            <option  value="">Select Class</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="exam_type_id">Exam Type<font style="color: red">*</font></label>
                                        <select class="form-control select2bs4" name="exam_type_id" id="exam_type_id">
                                            <option  value="">Select Year</option>
                                            @foreach($exam_type as $exam)
                                                <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-outline-info" style="margin-top: 31px">Search</button>
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
                    year_id: {
                        required: true,
                    },
                    class_id: {
                        required: true,
                    },
                    exam_type_id: {
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

