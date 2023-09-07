@extends('layouts.backend.app')

@section('title', 'Add user')

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
                            <h3 class="float-left">Add User</h3>
                            <p class="float-right "><a class="btn btn-info btn-sm" href="{{ route('view.user') }}"><i class="fa fa-list-alt"></i>  User List</a></p>
                        </div>
                        <div class="card-body">
                            <form id="quickForm" action="{{ route('store.user') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="role">User Role</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Operator">Operator</option>
                                        </select>
                                        <span style="color:red">{{ $errors->has('role') ? 'The user role field is required.' : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                                        <span style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="email">E-Mail</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="E-Mail">
                                        <span style="color:red">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                    </div>

                                    <div class="form-group col-md-6">
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

