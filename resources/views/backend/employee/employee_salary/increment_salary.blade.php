@extends('layouts.backend.app')

@section('title', 'Increament Salary')

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
                            <h3 class="float-left">Increament Salary</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.employee') }}"><i class="fa fa-list-alt"></i>  Employee List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForms" action="{{ route('store.increment.employee.salary', $increment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="increment_salary">Salary Amount <font style="color: red">*</font></label>
                                        <input type="text" name="increment_salary" id="increment_salary" value="{{ old('increment_salary') }}" placeholder="Salary Amount" class="form-control">
                                        <span style="color:red">{{ $errors->has('increment_salary') ? $errors->first('increment_salary') : '' }}</span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="effected_date">Effected Date <font style="color: red">*</font></label>
                                        <input type="text" name="effected_date" id="effected_date" value="{{ old('effected_date') }}" placeholder="dd/mm/yyy" class="form-control" autocomplete="off">
                                        <span style="color:red">{{ $errors->has('effected_date') ? $errors->first('effected_date') : '' }}</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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

                    "increment_salary": {
                        required: true,
                        number: true
                    },
                    "effected_date": {
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

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#effected_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy'
        });
    </script>


@endpush

