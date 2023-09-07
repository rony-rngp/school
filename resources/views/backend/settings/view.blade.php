@extends('layouts.backend.app')

@section('title', 'Settings')

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
                            <h3 class="float-left">Settings</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.settings') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">


                                    <div class="form-group col-md-4">
                                        <label for="working_days">Working Days</label>
                                        <input type="number" name="working_days" id="working_days" value="{{ $settings->working_days }}" class="form-control" placeholder="Working Days">
                                        <span style="color:red">{{ $errors->has('working_days') ? $errors->first('working_days') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
    <script>
        $(function () {
            $('#quickForm').validate({
                rules: {
                    role: {
                        required: true,
                    },
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength:30,
                    },
                    email: {
                        required: true,
                        email: true,
                    },

                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
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

