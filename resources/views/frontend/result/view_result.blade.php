@extends('layouts.frontend.app')

@section('title', 'Result PDF')

@push('css')

@endpush

@section('content')
    <header class="header">
        <!-- page header -->
        <div class="p-5">
            <h1 class="h1 text-center text-light p-3 font-weight-bold wow slideInRight">Result</h1>
        </div>
        <!-- end of page header -->
    </header>

    <!-- noticeboard section -->
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="notice p-3 mb-3 rounded wow slideInLeft">
                @if($p_date <= date('Y-m-d', strtotime(\Carbon\Carbon::today())))
                    <form id="quickForms" action="{{ route('get.student.result') }}" method="GET">
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
                                <label for="id_no">ID NO<font style="color: red">*</font></label>
                                <input type="text" name="id_no" id="id_no" class="form-control" placeholder="student id">
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                @else
                    <h3>Your result has not been published.Your result will be published on {{ $p_date }}</h3>
                @endif
            </div>
        </div>
    </section>
    <!-- end of noticeboard section -->
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
                    id_no: {
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
