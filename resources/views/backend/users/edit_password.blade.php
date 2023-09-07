@extends('layouts.backend.app')

@section('title', 'Change Password')

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
                            <h3 class="float-left">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('update.password') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                                        <span style="color:red">{{ $errors->has('current_password') ? $errors->first('current_password') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                                        <span style="color:red">{{ $errors->has('new_password') ? $errors->first('new_password') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="passwordd">Confirm Password</label>
                                        <input type="password" name="passwordd" id="passwordd" class="form-control" placeholder="Confirm Password">
                                        <span style="color:red">{{ $errors->has('passwordd') ? 'The confirm password field is required.' : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
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
                    current_password: {
                        required: true,
                    },
                    new_password: {
                        required: true,
                        minlength: 8,
                    },
                    passwordd: {
                        required: true,
                        equalTo: "#new_password"
                    },

                },
                messages: {
                    current_password: {
                        required: "Please enter current password",
                    },
                    new_password: {
                        required: "Please enter new password",
                    },
                    passwordd: {
                        required: "Please enter confirm password",
                        equalTo: "Confirm password don't match"
                    },
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

